const urlParams = new URLSearchParams(window.location.search);
const indexName = urlParams.get('index');

const search = instantsearch({
    appId: 'MQ39V1L64H',
    apiKey: 'e6398a37ffd863822b19ae8a558ac92b',
    indexName: indexName,
    routing: true
});


search.addWidget(
    instantsearch.widgets.searchBox({
        container: '#search-input',
        placeholder: 'Where do you want to search?',
        poweredBy: true,
        magnifier: true
    })
);

search.addWidget(
    instantsearch.widgets.sortBySelector({
        container: '#sort-by',
        autoHideContainer: true,
        indices: [
            {
                name: search.indexName,
                label: 'Most relevant',
            },
            {
                name: `${search.indexName}_price_asc`,
                label: 'Lowest price',
            }
        ]
    })
);

search.addWidget(
    instantsearch.widgets.stats({
        container: '#stats',
    })
);



search.addWidget(
    instantsearch.widgets.hits({
        container: '#hits',
        templates: {
            item: getTemplate('hit'),
            empty: getTemplate('no-results')
        },
        transformData: function(hit) {
          hit.indexName = indexName;
          if (hit.price > 1) {
              res = Math.floor(hit.price * 10) / 10 + " billions";
          } else {
              res = Math.floor(hit.price * 1000) + " millions";
          }
          hit.formatted_price = res;
          return hit;
        },
    })
);


search.addWidget(
    instantsearch.widgets.pagination({
        container: '#pagination',
        scrollTo: '#search-input',
    })
);

search.addWidget(
    instantsearch.widgets.refinementList({
        container: '#housing_type',
        attributeName: 'housing_type',
        operator: 'or',
        templates: {
            header: getHeader('Type of housing'),
        },
    })
);

function getTemplate(templateName) {
    return document.querySelector(`#${templateName}-template`).innerHTML;
}

function getHeader(title) {
    return `<h5>${title}</h5>`;
}

search.start();    