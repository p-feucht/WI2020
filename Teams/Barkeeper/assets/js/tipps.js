function addLike(tippId) {
    fetch('/api/tipps/add-like.php?id=' + tippId).then(res => {
        return res.json();
    }).then(data => {
        console.log(data);
        document.querySelector('#likes-counter-'+data.id).innerHTML = data.likes + ' Likes';
    });
}

(() => {
    let likeBtns = document.querySelectorAll('.like-tip-btn');
    for(let i = 0; i < likeBtns.length; i++) {
        likeBtns[i].addEventListener('click', ($event) => {
            $event.preventDefault();
            let id = $event.target.getAttribute('data-id');
            if(!id) {
                id = $event.target.closest('[data-id]').getAttribute('data-id');
            }
            addLike(id);
        });
    }
})();