<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AvailableService;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    private $paypal_base_url = "https://api.paypal.com";

    public function dashboard()
    {
        $appointments = Auth::user()->appointments()
            ->with('service')
            ->orderBy('appointment_date', 'desc')
            ->get();
            
        $services = AvailableService::where('status', 'active')->get();
        
        return view('frontend.dashboard', compact('appointments', 'services'));
    }
    
    public function store_old(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:available_services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'location_type' => 'required|in:home,venue',
            'address' => 'required|string|max:500',
            'special_requests' => 'nullable|string|max:1000',
        ]);
        
        $service = AvailableService::findOrFail($request->service_id);
        
        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'available_service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'location_type' => $request->location_type,
            'address' => $request->address,
            'special_requests' => $request->special_requests,
            'price' => $service->price,
            'status' => 'pending', // Or 'confirmed' based on your business logic
        ]);
        
        if (empty(Auth::user()->address)) {
            Auth::user()->update(['address' => $request->address]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Appointment booked successfully! We will confirm your appointment within 24 hours.',
            'appointment' => $appointment
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:available_services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'location_type' => 'required|in:home,venue',
            'address' => 'required|string|max:500',
            'special_requests' => 'nullable|string|max:1000',
        ]);
    
        $service = AvailableService::findOrFail($request->service_id);
    
        $user_reference = "Appointment_" . time() . "_U" . Auth::id();
    
        session(['booking_payload' => $request->all()]);
    
        // Create payment in PayPal
        $approvalUrl = $this->create_payment_paypal(
            $service->price,
            "USD",
            route('booking.paypal.success'),
            route('booking.paypal.cancel'),
            $user_reference,
            Auth::user()->email
        );
    
        if (!$approvalUrl) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to initiate PayPal payment. Please try again.'
            ]);
        }
    
        $payment = Payment::create([
            'user_id' => Auth::id(),
            'gateway' => 'paypal',
            'order_id' => null, // optional, v1 API doesn't return separate order ID
            'amount' => $service->price,
            'currency' => 'USD',
            'status' => 'pending',
            'raw_response' => json_encode(['reference' => $user_reference]),
        ]);
    
        session(['payment_id' => $payment->id]);
    
        return response()->json([
            'success' => true,
            'approval_url' => $approvalUrl,
            'message' => 'Redirect to PayPal to complete payment.'
        ]);
    }
    
    public function cancel($id)
    {
        $appointment = Appointment::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
            
        // Check if appointment can be cancelled (not within 24 hours)
        $appointmentDateTime = \Carbon\Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);
        $hoursDifference = now()->diffInHours($appointmentDateTime, false);
        
        if ($hoursDifference < 24) {
            return response()->json([
                'success' => false,
                'message' => 'Appointments can only be cancelled at least 24 hours in advance.'
            ], 400);
        }
        
        $appointment->update(['status' => 'cancelled']);
        
        return response()->json([
            'success' => true,
            'message' => 'Appointment cancelled successfully.'
        ]);
    }
    
    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);
        
        $appointment = Appointment::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
            
        $appointment->update([
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'rescheduled'
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Appointment rescheduled successfully.'
        ]);
    }




    public function create_payment_paypal($amount, $currency, $returnUrl, $cancelUrl, $user_reference, $email)
    {
        $paymentData = json_encode([
            "intent" => "sale",
            "payer" => [
                "payment_method" => "paypal",
                "payer_info" => [
                    "email" => $email // Add email to payer info
                ]
            ],
            "transactions" => [[
                "amount" => [
                    "total" => $amount,
                    "currency" => $currency
                ],
                "description" => $user_reference
            ]],
            "redirect_urls" => [
                "return_url" => $returnUrl,
                "cancel_url" => $cancelUrl
            ]
        ]);
        $url = $this->paypal_base_url . "/v1/payments/payment";
        $payment = $this->send_to_api_paypal($url,"POST", $paymentData);

        if (is_null($payment) || !isset($payment->links)) {
            return GeneralController::redirectWithMessage(true, "", "Please Try Again Later", "back");
        }

        foreach ($payment->links as $link) {
            if ($link->rel === 'approval_url') {
                return $link->href; // Return the approval URL
            }
        }

        return null; // Return null if no approval URL found
    }

    public function verify_paypal($paymentId, $payerId)
    {
        $url = $this->paypal_base_url."/v1/payments/payment/".$paymentId."/execute";
        $paymentResult = $this->send_to_api_paypal($url,"POST", json_encode(["payer_id" => $payerId]));

        if (isset($paymentResult->state) && $paymentResult->state === 'approved') {
            // Payment approved logic here
            return $paymentResult;
        }

        return null; // Return null if payment is not approved
    }


    public function paypalSuccess(Request $request)
{
    $paymentId = $request->paymentId;
    $payerId   = $request->PayerID;

    $paymentHistory = Payment::find(session('payment_id'));
    $bookingData = session('booking_payload');

    $paypalResult = $this->verify_paypal($paymentId, $payerId);

    if ($paypalResult) {
        // Payment approved, create appointment
        $service = AvailableService::findOrFail($bookingData['service_id']);

        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'available_service_id' => $service->id,
            'appointment_date' => $bookingData['appointment_date'],
            'appointment_time' => $bookingData['appointment_time'],
            'location_type' => $bookingData['location_type'],
            'address' => $bookingData['address'],
            'special_requests' => $bookingData['special_requests'] ?? null,
            'price' => $service->price,
            'status' => 'confirmed',
        ]);

        if (empty(Auth::user()->address)) {
            Auth::user()->update(['address' => $bookingData['address']]);
        }

        $paymentHistory->update([
            'appointment_id' => $appointment->id,
            'capture_id' => $paypalResult->id ?? null,
            'status' => 'completed',
            'raw_response' => json_encode($paypalResult),
        ]);

        session()->forget(['booking_payload', 'payment_id']);

        return GeneralController::redirectWithMessage(true, "Payment successful! Appointment confirmed.", "You have cancelled paypal payment initation, please try again", "back");

        
    }

    $paymentHistory->update(['status' => 'failed', 'raw_response' => json_encode($paypalResult)]);

    return GeneralController::redirectWithMessage(true, "Payment successful! Appointment confirmed.", "Payment failed or cancelled.", "back");

}


    private function send_to_api_paypal($url,$method, $data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));

        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->paypal_access_token()
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    private function paypal_access_token()
    {
        $client_id = env('PAYPAL_CLIENT_ID');
        $secret_key = env('PAYPAL_SECRET_KEY');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$this->paypal_base_url/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_USERPWD, "AcNr71oN4IBUQhkPZY-G7328zjbs2LKkG22zytA7iVaMom6sdlR1B8ET7D9P4ajNcrHlRYDK0d7rYmki:EDPMMX4MLKvgz-eNvOi75r9uUd1CQutsJ4dRSa1cXHSDEyaBsd-fRpsB1wQSOIr09Np0VFrPHcaqf0tW");
        curl_setopt($ch, CURLOPT_USERPWD, $client_id.":".$secret_key);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $headers = [
            "Accept: application/json",
            "Accept-Language: en_US"
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response);
        return $responseData->access_token ?? null; // Return null if access token not found
    }




    public  function paypal_failed()
    {
        return GeneralController::redirectWithMessage(false, "", "You have cancelled paypal payment initation, please try again", "back");
    }


    public function payment(){
        $payments = Payment::where('user_id', Auth::id())
        ->with(['appointment']) // if you have relationship
        ->orderBy('created_at', 'desc')
        ->get();
        $totalPayments = $payments->where('status', 'completed')->sum('amount');

        return view('frontend.payment', compact('payments', 'totalPayments'));
    }

    public function user_profile(){
        return view('frontend.profile');
    }

    
}