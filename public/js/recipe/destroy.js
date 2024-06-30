// //削除の確認
document.addEventListener('DOMContentLoaded', function() {
    var destroy = document.getElementById('delete');
    if (destroy) {
        destroy.addEventListener('click', function(evt) {
            if (!confirm('本当に削除しますか？')) {
                evt.preventDefault();
            }
        });
    }

    var destroyComment = document.getElementById('delete-comment');
    if (destroyComment) {
        destroyComment.addEventListener('click', function(evt) {
            if (!confirm('本当に削除しますか？')) {
                evt.preventDefault();
            }
        });
    }
});
