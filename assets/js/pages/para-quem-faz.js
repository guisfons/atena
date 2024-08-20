document.querySelectorAll('.objetivos__head-tab').forEach(function(tab) {
    tab.addEventListener('click', function() {
        let modelo = this.dataset.modelo

        document.querySelector('.objetivos__head-tab--active').classList.remove('objetivos__head-tab--active')
        this.classList.add('objetivos__head-tab--active')

        document.querySelector('.objetivos__head-text--active').classList.remove('objetivos__head-text--active')
        document.querySelector('.objetivos__head-text[data-modelo="'+modelo+'"]').classList.add('objetivos__head-text--active')

        document.querySelector('.objetivos__content--active').classList.remove('objetivos__content--active')
        document.querySelector('.objetivos__content[data-modelo="'+modelo+'"]').classList.add('objetivos__content--active')
    })
})

document.querySelectorAll('.objetivos__label').forEach(function(tab) {
    tab.addEventListener('click', function() {
        let ods = this.dataset.ods

        document.querySelector('.objetivos__label--active').classList.remove('objetivos__label--active')
        this.classList.add('objetivos__label--active')

        document.querySelector('.objetivos__ods--active').classList.remove('objetivos__ods--active')
        document.querySelector('.objetivos__ods[data-ods="'+ods+'"]').classList.add('objetivos__ods--active')
    })
})

document.addEventListener('DOMContentLoaded', function () {
    const articles = document.querySelectorAll('article');

    articles.forEach((article) => {
        let elements = Array.from(article.children);
        let newContent = [];
        let currentGroup = [];
        let insideGroup = false;

        elements.forEach((el) => {
            if (el.tagName === 'H5') {
                if (insideGroup && currentGroup.length > 0) {
                    let groupContainer = document.createElement('div');
                    groupContainer.classList.add('objetivos__page-group');
                    currentGroup.forEach(groupEl => groupContainer.appendChild(groupEl));
                    newContent.push(groupContainer);
                    currentGroup = [];
                }
                insideGroup = true;
                currentGroup.push(el);
            } else if (el.tagName === 'HR') {
                if (insideGroup) {
                    currentGroup.push(el);
                    let groupContainer = document.createElement('div');
                    groupContainer.classList.add('objetivos__page-group');
                    currentGroup.forEach(groupEl => groupContainer.appendChild(groupEl));
                    newContent.push(groupContainer);
                    currentGroup = [];
                    insideGroup = false;
                } else {
                    newContent.push(el);
                }
            } else {
                if (insideGroup) {
                    currentGroup.push(el);
                } else {
                    newContent.push(el);
                }
            }
        });

        if (currentGroup.length > 0) {
            let groupContainer = document.createElement('div');
            groupContainer.classList.add('objetivos__page-group');
            currentGroup.forEach(groupEl => groupContainer.appendChild(groupEl));
            newContent.push(groupContainer);
        }

        article.innerHTML = '';
        newContent.forEach(content => article.appendChild(content));
    });

    document.querySelectorAll('.objetivos__page-group').forEach(function(el) {
        el.addEventListener('click', function() {
            this.classList.toggle('objetivos__page-group--active')
        })
    })
});

pagination()

function pagination() {
    document.querySelectorAll('.objetivos__pager').forEach(function(e) {
        if(e.closest('.objetivos__ods').querySelector('.objetivos__page--active').dataset.page == 1) {
            e.closest('.objetivos__nav').querySelector('.objetivos__pager--prev').classList.add('objetivos__pager--disabled')
        }
        
        e.addEventListener('click', function() {
            let pages = this.closest('.objetivos__ods').querySelectorAll('.objetivos__page').length
            let currentPage = this.closest('.objetivos__ods').querySelector('.objetivos__page--active')

            if(this.classList.contains('objetivos__pager--disabled')) {
                return
            }

            if(this.classList.contains('objetivos__pager--next')) {
                currentPage.nextElementSibling.classList.add('objetivos__page--active')
                currentPage.classList.remove('objetivos__page--active')
                this.closest('.objetivos__nav').querySelector('.objetivos__pager--prev').classList.remove('objetivos__pager--disabled')

                if(currentPage.dataset.page <= pages) {
                    this.classList.add('objetivos__pager--disabled') 
                    return
                }
            }

            if(this.classList.contains('objetivos__pager--prev')) {
                currentPage.previousElementSibling.classList.add('objetivos__page--active')
                currentPage.classList.remove('objetivos__page--active')
                this.closest('.objetivos__nav').querySelector('.objetivos__pager--next').classList.remove('objetivos__pager--disabled')

                if(currentPage.dataset.page - 1 == 1) {
                    this.classList.add('objetivos__pager--disabled') 
                    return
                }
            }
        })
    })
}