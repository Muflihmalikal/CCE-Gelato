import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', function () {
    ClassicEditor
        .create(document.querySelector('#editor'), {
            licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NzExMTM1OTksImp0aSI6IjhhMzUxMjUzLWU3ODgtNDc1NC05YjRlLWJjNzdkYzU1YWFmZSIsImxpY2Vuc2VkSG9zdHMiOlsiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImxpY2Vuc2VUeXBlIjoiZGV2ZWxvcG1lbnQiLCJmZWF0dXJlcyI6WyJEUlVQIl0sInZjIjoiMmM2YzFlZmUifQ._zFW4bgnNgCWsRfNhFIzS_XX4W5VQO9roAvs4T8AlLXnRLSyPfjXFrLeqZ1CSxIXhyD0wVMnUcrnnYw-S8eBrQ',
            ckfinder: {
                uploadUrl: '/filemanager/upload?type=Images&_token=' + document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .catch(error => {
            console.error('CKEditor error:', error);
        });

});
