@extends('frontend.app')

@section('content')
<main>
    <!-- Dashboard Section -->
    <section id="dashboard" class="section-padding light-bg">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <div class="w-24 h-1 gold-bg mx-auto mb-8"></div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                @include('frontend.sidebar')
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    
                    <!-- Payments Tab -->
                    <div id="payments-tab" class="dashboard-content">
                        <div class="dashboard-card">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-2xl font-bold">Payment History</h3>
                                <div class="text-sm text-gray-600">
                                    Total: <span id="total-payments" class="font-bold gold-text">${{ number_format($totalPayments, 2) }}</span>
                                </div>
                            </div>
                            
                            <!-- Payments Table -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gateway</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                                            {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="payments-body" class="bg-white divide-y divide-gray-200">
                                        <!-- Payments will be loaded here by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div id="pagination-container" class="mt-6 flex justify-between items-center">
                                <div class="text-sm text-gray-600">
                                    Showing <span id="page-info">0</span> of {{ $payments->count() }} payments
                                </div>
                                <div class="flex space-x-2">
                                    <button id="prev-page" class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50" disabled>
                                        Previous
                                    </button>
                                    <div id="page-numbers" class="flex space-x-1">
                                        <!-- Page numbers will be inserted here -->
                                    </div>
                                    <button id="next-page" class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50" disabled>
                                        Next
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Empty State -->
                            <div id="empty-state" class="text-center py-12 hidden">
                                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-6">
                                    <i class="fas fa-receipt text-3xl text-gray-400"></i>
                                </div>
                                <h4 class="text-xl font-bold mb-2">No Payment History</h4>
                                <p class="text-gray-600">You haven't made any payments yet.</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Pass data to JavaScript -->
<script>
    window.paymentsData = @json($payments);
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const payments = window.paymentsData || [];
    const itemsPerPage = 10;
    let currentPage = 1;
    
    // DOM Elements
    const paymentsBody = document.getElementById('payments-body');
    const pageNumbers = document.getElementById('page-numbers');
    const prevButton = document.getElementById('prev-page');
    const nextButton = document.getElementById('next-page');
    const pageInfo = document.getElementById('page-info');
    const emptyState = document.getElementById('empty-state');
    
    // Format currency
    function formatCurrency(amount, currency = 'USD') {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: currency
        }).format(amount);
    }
    
    // Format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }
    
    // Get status badge class
    function getStatusClass(status) {
        switch(status) {
            case 'completed':
                return 'bg-green-100 text-green-800';
            case 'pending':
                return 'bg-yellow-100 text-yellow-800';
            case 'failed':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }
    
    // Render payments for current page
    function renderPayments() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const currentPayments = payments.slice(startIndex, endIndex);
        
        // Show/hide empty state
        if (payments.length === 0) {
            emptyState.classList.remove('hidden');
            paymentsBody.innerHTML = '';
            return;
        } else {
            emptyState.classList.add('hidden');
        }
        
        // Clear table body
        paymentsBody.innerHTML = '';
        
        // Render payments
        currentPayments.forEach(payment => {
            const row = document.createElement('tr');
            
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${formatDate(payment.created_at)}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 capitalize">${payment.gateway}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-gray-900">${formatCurrency(payment.amount, payment.currency)}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(payment.status)}">
                        ${payment.status}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 font-mono">${payment.capture_id || payment.order_id || 'N/A'}</div>
                </td>
                <td style="display:none;" class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="viewPaymentDetails('${payment}')" class="text-indigo-600 hover:text-indigo-900 mr-3">
                        View
                    </button>
                    ${payment.status === 'completed' ? `
                    <button onclick="downloadReceipt('${payment.id}')" class="text-green-600 hover:text-green-900">
                        Receipt
                    </button>
                    ` : ''}
                </td>
            `;
            
            paymentsBody.appendChild(row);
        });
        
        // Update page info
        const totalPages = Math.ceil(payments.length / itemsPerPage);
        const start = Math.min((currentPage - 1) * itemsPerPage + 1, payments.length);
        const end = Math.min(currentPage * itemsPerPage, payments.length);
        pageInfo.textContent = `${start}-${end}`;
        
        // Update pagination buttons
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages;
        
        // Render page numbers
        renderPageNumbers(totalPages);
    }
    
    // Render page number buttons
    function renderPageNumbers(totalPages) {
        pageNumbers.innerHTML = '';
        
        // Always show first page
        addPageButton(1);
        
        // Show ellipsis if needed
        if (currentPage > 3) {
            const ellipsis = document.createElement('span');
            ellipsis.className = 'px-3 py-2';
            ellipsis.textContent = '...';
            pageNumbers.appendChild(ellipsis);
        }
        
        // Show pages around current page
        for (let i = Math.max(2, currentPage - 1); i <= Math.min(totalPages - 1, currentPage + 1); i++) {
            if (i > 1 && i < totalPages) {
                addPageButton(i);
            }
        }
        
        // Show ellipsis if needed
        if (currentPage < totalPages - 2) {
            const ellipsis = document.createElement('span');
            ellipsis.className = 'px-3 py-2';
            ellipsis.textContent = '...';
            pageNumbers.appendChild(ellipsis);
        }
        
        // Always show last page if there is more than one page
        if (totalPages > 1) {
            addPageButton(totalPages);
        }
    }
    
    // Add a page button
    function addPageButton(pageNumber) {
        const button = document.createElement('button');
        button.className = `px-3 py-2 rounded ${currentPage === pageNumber ? 'bg-blue-500 text-white' : 'bg-gray-200'}`;
        button.textContent = pageNumber;
        button.onclick = () => goToPage(pageNumber);
        pageNumbers.appendChild(button);
    }
    
    // Go to specific page
    function goToPage(page) {
        currentPage = page;
        renderPayments();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    
    // Event listeners
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderPayments();
        }
    });
    
    nextButton.addEventListener('click', () => {
        const totalPages = Math.ceil(payments.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPayments();
        }
    });
    
    // Filter and search functionality (optional)
    function setupSearch() {
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.placeholder = 'Search payments...';
        searchInput.className = 'px-4 py-2 border rounded-lg w-full max-w-xs mb-4';
        searchInput.oninput = function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // Filter logic here
        };
        
        const header = document.querySelector('.dashboard-card h3').parentElement;
        header.appendChild(searchInput);
    }
    
    // Initialize
    renderPayments();
    // setupSearch(); // Uncomment if you want search functionality
});

// Payment detail functions
function viewPaymentDetails(payment) {
                showPaymentModal(payment);

}

function downloadReceipt(paymentId) {
    // Implement receipt download
    window.open(`/payments/${paymentId}/receipt`, '_blank');
}

function showPaymentModal(payment) {
    // Create and show modal with payment details
    const modalHtml = `
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 max-w-lg w-full">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold">Payment Details</h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Amount:</span>
                        <span class="font-semibold">${payment.amount} ${payment.currency}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-semibold">${payment.status}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Gateway:</span>
                        <span class="font-semibold">${payment.gateway}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Date:</span>
                        <span class="font-semibold">${new Date(payment.created_at).toLocaleString()}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Transaction ID:</span>
                        <span class="font-semibold">${payment.capture_id || 'N/A'}</span>
                    </div>
                </div>
                <div style="display:none;" class="mt-6 flex justify-end">
                    <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 rounded-lg mr-2">Close</button>
                    ${payment.status === 'completed' ? `
                    <button onclick="downloadReceipt('${payment.id}')" class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                        Download Receipt
                    </button>
                    ` : ''}
                </div>
            </div>
        </div>
    `;
    
    const modal = document.createElement('div');
    modal.innerHTML = modalHtml;
    document.body.appendChild(modal);
}

function closeModal() {
    const modal = document.querySelector('.fixed.inset-0');
    if (modal) {
        modal.remove();
    }
}
</script>
@endsection