<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKEditor 5 - Quick start CDN</title>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.2.0/ckeditor5.css">
    <style>
        .main-container {
            width: 795px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div id="editor">
            <p>Hello from CKEditor 5!</p>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/44.2.0/ckeditor5.umd.js"></script>
    <script>
        const {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Subscript,
            Superscript,
            Paragraph,
            Image,
            ImageCaption,
            ImageResize,
            ImageStyle,
            ImageToolbar,
            LinkImage
        } = CKEDITOR;

        ClassicEditor
            .create(document.querySelector('#editor'), {
                image: {
                    insert: {
                        // This is the default configuration, you do not need to provide
                        // this configuration key if the list content and order reflects your needs.
                        integrations: ['upload', 'assetManager', 'url']
                    }
                },
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NzExMTM1OTksImp0aSI6IjhhMzUxMjUzLWU3ODgtNDc1NC05YjRlLWJjNzdkYzU1YWFmZSIsImxpY2Vuc2VkSG9zdHMiOlsiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImxpY2Vuc2VUeXBlIjoiZGV2ZWxvcG1lbnQiLCJmZWF0dXJlcyI6WyJEUlVQIl0sInZjIjoiMmM2YzFlZmUifQ._zFW4bgnNgCWsRfNhFIzS_XX4W5VQO9roAvs4T8AlLXnRLSyPfjXFrLeqZ1CSxIXhyD0wVMnUcrnnYw-S8eBrQ', // Create a free account on https://portal.ckeditor.com/checkout?plan=free
                plugins: [Essentials, Bold, Italic, Font, Subscript, Superscript, Paragraph, Image, ImageToolbar, ImageCaption, ImageStyle, ImageResize, LinkImage],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'Subscript', 'Superscript', 'fontColor', 'fontBackgroundColor', 'insertImage'
                ]

            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>