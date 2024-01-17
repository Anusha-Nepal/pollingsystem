<html>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
           
            $("#choices-container").on("click", ".add-choice", function () {
                var choiceGroup = $(this).closest(".choice-group");
                var newChoiceGroup = choiceGroup.clone();

               
                newChoiceGroup.find("input").val('');

              
                $("#choices-container").append(newChoiceGroup);
            });

           
            $("#choices-container").on("click", ".remove-choice", function () {
                var choiceGroup = $(this).closest(".choice-group");

              
                if ($("#choices-container .choice-group").length > 1) {
                    choiceGroup.remove();
                } else {
                   
                    alert("At least one choice is required.");
                }
            });
        });
    </script>
    <style>
        .container {
            margin-top: 50px;
        }
    
        .card {
            margin-bottom: 20px;
        }
    
        .card-header {
            background-color: #3490dc;
            color: #ffffff;
        }
    
        .form-group {
            margin-bottom: 20px;
        }
    
        label {
            font-weight: bold;
        }
    
        textarea {
            resize: vertical;
        }
    
        button {
            background-color: #3490dc;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    
        button:hover {
            background-color: #2779bd;
        }
    </style>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(Session::has('error'))
                <p >{{ Session::get('error') }}</p>
                @endif
                @csrf
                                    <div class="card-body">
                
                                        <div class="container">
                                            <h2>Create a New Poll</h2>
                                        
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        
                                            <form method="POST" action="{{ route('poll.store') }}">
                                                @csrf
                                        
                                                <div class="form-group">
                                                    <label for="title">Title:</label>
                                                    <input type="text" name="title" id="title" class="form-control" required>
                                                </div>
                                        
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                    <textarea name="description" id="description" class="form-control"></textarea>
                                                </div>
                                        
                                                <div class="form-group">
                                                    <label for="choices">Choices:</label>
                                                    <div id="choices-container">
                                                        <div class="choice-group">
                                                            <input type="text" name="choices[]" class="form-control" required>
                                                            <button type="button" class="add-choice">Add Choice</button>
                                                            <button type="button" class="remove-choice">Remove Choice</button>
                                                        </div>
                                                    </div>
                                                </div>
                                               <div class="form-group">
    <label for="start_date">Start Date and Time:</label>
    <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
</div>

<div class="form-group">
    <label for="end_date">End Date and Time:</label>
    <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
</div>

                                                
<button type="submit" class="btn btn-primary">Create Poll</button>
 </form>
<a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
</div>
</html>