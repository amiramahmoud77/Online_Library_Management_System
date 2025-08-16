<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Book</title>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: #f3e8f0; /* لون بيج فاتح مائل للبنفسجي */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        background: #fff5fb; /* خلفية الفرم */
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(128, 0, 128, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .container:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(128, 0, 128, 0.4);
    }

    h2 {
        color: #6a0dad; /* بنفسجي */
        text-align: center;
        margin-bottom: 30px;
        text-shadow: 1px 1px 3px #f3e8f0;
        animation: glow 2s infinite alternate;
    }

    @keyframes glow {
        from { text-shadow: 0 0 5px #6a0dad, 0 0 10px #d7b2e0; }
        to { text-shadow: 0 0 20px #6a0dad, 0 0 30px #d7b2e0; }
    }

    label {
        color: #6a0dad;
        font-weight: 600;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #d7b2e0;
        transition: box-shadow 0.3s, border-color 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #6a0dad;
        box-shadow: 0 0 8px rgba(106, 13, 173, 0.3);
        outline: none;
    }

    .btn-success {
        background: linear-gradient(45deg, #6a0dad, #d7b2e0);
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-success:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(106, 13, 173, 0.4);
    }

    .btn-secondary {
        background: #f3e8f0;
        color: #6a0dad;
        border: 1px solid #6a0dad;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-secondary:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(106, 13, 173, 0.2);
        color: #fff;
        background: #6a0dad;
    }

    #preview {
        border-radius: 10px;
        border: 1px solid #d7b2e0;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    #preview:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(106, 13, 173, 0.4);
    }
</style>
</head>
<body>
<div class="container mt-5">
    <h2>Add New Book</h2>
    <form id="bookForm" action="/admin/books" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="mb-3">
            <label for="name" class="form-label">Book Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Book Photo</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            <img id="preview" class="img-fluid mt-2" style="max-height:200px; display:none;">
        </div>

        <div class="mb-3">
            <label for="available_copies" class="form-label">Available Copies</label>
            <input type="number" class="form-control" id="available_copies" name="available_copies" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="mb-3">
            <label for="publish_year" class="form-label">Publish Year</label>
            <input type="date" class="form-control" id="publish_year" name="publish_year" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Book</button>
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
       <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>


    </form>



</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('photo').addEventListener('change', function(e){
    const preview = document.getElementById('preview');
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(event){
            preview.src = event.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>
</body>
</html>

