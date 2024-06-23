// //削除の確認
document.addEventListener('DOMContentLoaded', function() {
    var destroy = document.getElementById('delete');

    destroy.addEventListener('click', function(evt) {
        if (!confirm('本当に削除しますか？')) {
            evt.preventDefault();
        }
    });
});
