@extends('layouts.app')
@section('content')
    <title>My Notes</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
    body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .wrapper,
        .noteContainer {
            width: 100%;
        }

        .noteContainer {
            display: flex;
            flex-wrap: wrap;
        }

        .note-card {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 10px;
            padding: 15px;
            width: 200px;
            min-height: 150px;
            display: flex;
            flex-direction: column;
        }

        .note-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .note-description {
            font-size: 14px;
            color: #555;
            flex-grow: 1;
        }

        .note-created {
            font-size: 12px;
            color: #888;
            margin-top: 10px;
        }

        .search-bar {
            text-align: center;
        }

        .add-note-form {
            display: none;
            padding: 20px;
            border-radius: 8px;
            margin: auto;
            margin-bottom: 15px;
        }

        .notesFormPar {
            background-color:#fff;
            box-shadow:2px 2px 20px #ccc;
            width:50%;
            margin:auto;
            padding: 0.6rem;
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        #noteForm input,
        #noteForm textarea {
            width: 100%;
            padding: 8px;
        }

        #noteForm input {
            border:0;
            margin-bottom:20px
        }

        #noteForm textarea {
            border:0;
        }
        .archive-icon {
        cursor: pointer;
        margin-top: 10px;
    }

    </style>
</head>
<body>

<div class="notesFormPar">
        <div class="search-bar" onclick="showAddNoteForm()">
            <span style="border-bottom: 1px dashed #aaa; cursor: pointer;">Add Note</span>
        </div>


        <div class="add-note-form">
            <form id="noteForm">

                <input type="text" id="title" name="title" placeholder="Title" required><br>

                <textarea id="description" name="description" placeholder="Description" required></textarea><br>

                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />

                <button type="button" onclick="saveNote()">Save</button>
            </form>

        </div>
</div>


<div class="edit-note-form-container" style="display: none;">
    <div class="edit-note-form">
        <form id="editNoteForm">
            <input type="text" id="edit-title" name="edit-title" placeholder="Title" required><br>
            <textarea id="edit-description" name="edit-description" placeholder="Description" required></textarea><br>
            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
            <button type="button" onclick="updateNote()">Update</button>
        </form>
    </div>
</div>

<div class="noteContainer">
<?php
foreach ($notes as $note) {
    echo '<div class="note-card">';
    echo '<div class="note-title">' . $note->title . '</div>';
    echo '<div class="note-description">' . $note->description . '</div>';
    echo '<div class="note-created">Created on ' . $note->created_on . '</div>';
    echo '<div class="archive-icon" onclick="archiveNote('.$note->id.')">&#128465; Archive</div>';
    echo '<div class="edit-icon" onclick="editNote('.$note->id.')">&#9998; Edit</div>';
    echo '</div>';
}
?>
</div>

<script>
    function showAddNoteForm() {
        $('.add-note-form').show();
    }
    function saveNote() {
        const title = $('#title').val();
        const description = $('#description').val();
        const csrfToken = $('#csrf-token').val();

        $.ajax({
            url: '{{ route('save-note') }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken 
            },
            contentType: 'application/json',
            data: JSON.stringify({ title, description }),
            success: function (newNote) {
                console.log(newNote);
                $('.add-note-form').hide();

                const NewNote = newNote[0];

                const noteCard = $('<div class="note-card"></div>');
                noteCard.html(`
                    <div class="note-title">${NewNote.title}</div>
                    <div class="note-description">${NewNote.description}</div>
                    <div class="note-created">Created on ${NewNote.created_on}</div>
                `);

                $('.noteContainer').append(noteCard);

            }
        });
    }
</script>

<script>
    function archiveNote(noteId) {
        const csrfToken = $('#csrf-token').val();
        console.log(noteId);

        $.ajax({
            url: '{{ route('archive-note') }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: { noteId: noteId },
            success: function (response) {
                if (response.success) {
                    $(`.note-card:has([onclick="archiveNote(${noteId})"])`).remove();
                } else {
                    console.error('Failed to archive note.');
                }
            }
        });
    }

    // -----------------------------
    function editNote(noteId) {
    const csrfToken = $('#csrf-token').val();
    
    $.ajax({
        url: '{{ route('get-note') }}',
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: { noteId: noteId },
        success: function (note) {
            showEditNoteForm(note);
        }      
        });
        }

        function showEditNoteForm(note) {
            $('#edit-title').val(note.title);
            $('#edit-description').val(note.description);
            $('.edit-note-form').show();
        }
        $('.edit-note-form button').on('click', function () {
            updateNote();
        });

        function updateNote() {
            const title = $('#edit-title').val();
            const description = $('#edit-description').val();
            const csrfToken = $('#csrf-token').val();

            $.ajax({
                url: '{{ route('update-note') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken 
                },
                contentType: 'application/json',
                data: JSON.stringify({ title, description }),
                success: function (updatedNote) {
                    console.log(updatedNote);
                    
                    $('.edit-note-form').hide();
                  
                    const updatedNoteCard = $('<div class="note-card"></div>');
                    updatedNoteCard.html(`
                        <div class="note-title">${updatedNote.title}</div>
                        <div class="note-description">${updatedNote.description}</div>
                        <div class="note-created">Created on ${updatedNote.created_on}</div>
                    `);

                    
                    $(`.note-card:has([onclick="editNote(${updatedNote.id})"])`).replaceWith(updatedNoteCard);
                }
            });
        }

</script>

</body>
</html>
@endsection


