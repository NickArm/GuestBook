<div class="mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFAQModal"
        onclick="handleModalOpen()">Add FAQ</button>
</div>
<h3>FAQs</h3>
@if ($faqs->isEmpty())
    <p>No FAQs available for this property.</p>
@else
    <div class="m-0">
        <?php $i = 0; ?>
        @foreach ($faqs as $faq)
            <?php $i++; ?>
            <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse"
                data-bs-target="#kt_job_4_{{ $i }}" aria-expanded="false">
            <!--begin::Icon-->
            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
																	<!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
																	<span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
																			<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																	<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
																	<span class="svg-icon toggle-off svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
																			<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
																			<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</div>
																<!--end::Icon-->

                <!--begin::Title-->
                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                    {{ $faq->question }}
                </h4>
                <!--end::Title-->
            </div>
            <!--end::Heading-->
            <div id="kt_job_4_{{ $i }}" class="fs-6 ms-1 collapse" style="">
                <!--begin::Text-->
                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                    {{ $faq->answer }}
                    <div class="mt-4">
                        <button type="button" class="btn btn-light-warning btn-sm" data-faq-id="{{ $faq->id }}" onclick="handleEditClick(this)">Edit FAQ</button>
                        <button type="button" class="btn btn-light-danger btn-sm" data-faq-id="{{ $faq->id }}" data-delete-url="{{ route('faq.destroy', $faq->id) }}" onclick="handleDeleteClick(this)">Delete FAQ</button>
                    </div>
                </div>
               
            </div>
            <div class="separator separator-dashed"></div>
        @endforeach
    </div>
@endif


<!-- Add a new FAQ Modal -->
<div class="modal fade" id="addFAQModal" tabindex="-1" aria-labelledby="addFAQModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFAQModalLabel">Add a new FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('faq.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">
                        <div class="mb-3">
                            <label for="faq_category" class="form-label">Select Category</label>
                            <select class="form-control" id="faq_category" name="category_id" required
                                onchange="checkNewCategorySelected(this);">
                                <!-- Existing categories -->
                                @foreach ($faq_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                <!-- Option to add a new category -->
                                <option value="new">Add New Category</option>
                            </select>
                        </div>
                        <!-- Input for the new category name (hidden by default) -->
                        <div class="mb-3" id="newCategoryInput" style="display: none;">
                            <label for="new_category_name" class="form-label">New Category Name</label>
                            <input type="text" class="form-control" id="new_category_name" name="new_category_name">
                        </div>
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" required>
                        </div>
                        <div class="mb-3">
                            <label for="answer" class="form-label">Answer</label>
                            <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 'Edit FAQ' Modal -->
    <div class="modal fade" id="editFAQModal" tabindex="-1" aria-labelledby="editFAQModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFAQModalLabel">Edit FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editFAQForm" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <input type="hidden" id="edit_faq_id" name="faq_id">
                        <div class="mb-3">
                            <label for="edit_faq_category" class="form-label">Select Category</label>
                            <select class="form-control" id="edit_faq_category" name="category_id" required>
                                <!-- Categories will be populated dynamically via JavaScript -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_question" class="form-label">Question</label>
                            <input type="text" class="form-control" id="edit_question" name="question" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_answer" class="form-label">Answer</label>
                            <textarea class="form-control" id="edit_answer" name="answer" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




<script>
    document.getElementById('editFAQForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = event.target;
        var formData = new FormData(form);
        var faqId = formData.get('faq_id');
        fetch(`/faq/update/${faqId}`, {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok.');
            }
            return response.json();
        })
        .then(data => {           
                // Handle successful update (e.g., close modal, refresh list)
                $('#editFAQModal').modal('hide');
                location.reload();    
        })
        .catch(error => {
            console.error('Error updating FAQ:', error);
        });
    });



    function handleEditClick(button) {
        var faqId = button.getAttribute('data-faq-id');
        fetch(`/faq/edit/${faqId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP status ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Check if the data has the expected properties
            if (data && data.faq) {
                document.getElementById('edit_faq_id').value = data.faq.id; // Adjusted from faqId to data.faq.id
                document.getElementById('edit_question').value = data.faq.question; // Adjusted for nested data
                document.getElementById('edit_answer').value = data.faq.answer; // Adjusted for nested data

                // Populate the category dropdown if categories are included in the response
                if (Array.isArray(data.categories)) {
                    var categorySelect = document.getElementById('edit_faq_category');
                    categorySelect.innerHTML = '';
                    data.categories.forEach(category => {
                        var option = document.createElement('option');
                        option.value = category.id;
                        option.text = category.name;
                        option.selected = category.id === data.faq.category_id;
                        categorySelect.appendChild(option);
                    });
                }
            } else {
                console.error('Unexpected data structure:', data);
            }

            // Show the edit modal
            var editFAQModal = new bootstrap.Modal(document.getElementById('editFAQModal'));
            editFAQModal.show();
        })
        .catch(error => {
            console.error('Error fetching FAQ data:', error);
        });
    }


    function handleDeleteClick(button) {
    if (confirm('Are you sure you want to delete this FAQ?')) {
        var faqId = button.getAttribute('data-faq-id');
        var deleteUrl = `/faq/destroy/${faqId}`;
        fetch(deleteUrl, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // CSRF token
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('FAQ deleted successfully!');
                location.reload();
            } else {
                alert('Failed to delete FAQ: ' + (data.message || 'An error occurred.'));
            }
        })
        .catch(error => {
            console.error('Error deleting FAQ:', error);
            alert('Failed to delete FAQ: ' + error.message);
        });
    }
}



</script>


