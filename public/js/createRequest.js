function checkSelectedStudents() {
    const selectedStudents = Array.from(document.querySelectorAll('input[name="selected_students[]"]:checked'));
    if (selectedStudents.length === 0) {
        alert('Vui lòng chọn ít nhất một sinh viên.');
    } else {
        showRequestForm();
    }
}

function showRequestForm() {
    document.getElementById('requestModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('requestModal').style.display = 'none';
}

function submitRequest() {
    const selectedStudents = Array.from(document.querySelectorAll('input[name="selected_students[]"]:checked'))
        .map(checkbox => checkbox.value);

    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const deadline = document.getElementById('deadline').value;
    const lecturerId = document.getElementById('lecturerId').value;

    fetch('http://localhost:3000/application/server/save_request.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            title,
            description,
            deadline,
            students: selectedStudents,
            lecturer_id: lecturerId,
            created_at: new Date().toISOString()
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Yêu cầu đã được lưu thành công!');
            document.getElementById('newRequestForm').reset();
            closeModal();
            resetCheckboxes();
        } else {
            alert('Đã xảy ra lỗi khi lưu yêu cầu.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function resetCheckboxes() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
}

document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('input[name="selected_students[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

document.getElementById('filterInput').addEventListener('keyup', function() {
    const filterValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#studentTable tbody tr');

    rows.forEach(row => {
        const projectName = row.cells[1].textContent.toLowerCase();
        const studentName = row.cells[2].textContent.toLowerCase();
        if (projectName.includes(filterValue) || studentName.includes(filterValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}); 