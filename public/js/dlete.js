const article = document.getElementById('delete');

if (article) {
    article.addEventListener('click', e => {
            if (e.target.className === 'btn btn-danger mb-2') {
                if(confirm('Are you sure you want delete this article?')){
                    const id = e.target.getAttribute('data-id');

                    fetch(`/Articles/delete/${id}`, {
                        method: 'DELETE'
                    }).then(res => window.location.reload());
             }
        }
    } );
}
