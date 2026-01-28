$(document).on('click', '.preview-btn', function(e) {
    e.preventDefault();
    const url = $(this).attr('href');

    $('#preview-content').html(`
        <div class="text-center py-5">
            <div class="spinner-border"></div>
            <p class="mt-2 text-muted">Loading preview…</p>
        </div>
    `);

    $.get(url)
        .done(function(data) {
            $('#preview-content').html(data);
        })
        .fail(function() {
            $('#preview-content').html(
                '<div class="alert alert-danger">Failed to load preview</div>'
            );
        });
});