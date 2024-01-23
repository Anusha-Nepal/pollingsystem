


    
    <html>
        <head>
            <style>
                /* Container styles */
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

/* Heading styles */
h2 {
    color: #333;
}

/* Form styles */
form {
    margin-top: 20px;
}

/* Form group styles */
.form-group {
    margin-bottom: 20px;
}

/* Label styles */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Input and textarea styles */
input[type="text"],
textarea {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-top: 5px;
    margin-bottom: 10px;
}

/* Button styles */
button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

/* Cancel button styles */
.btn-secondary {
    background-color: #6c757d;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-secondary:hover {
    background-color: #545b62;
}

                </style>
        </head>
        <body>
        <div class="container">
        <h2>Edit Poll</h2>
        <form method="POST" action="{{ route('poll.update', $poll->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $poll->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control">{{ $poll->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Poll</button>
        </form>
        <a href="{{ route('poll.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
        </body>
    </html>
