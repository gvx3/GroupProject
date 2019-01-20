var client = algoliasearch('MQ39V1L64H', 'e6398a37ffd863822b19ae8a558ac92b');
var buyIndex = client.initIndex('buy');
var rentIndex = client.initIndex('rent');


// with params
buyIndex.search(
  {
    query: '',
    attributesToRetrieve: ['objectID', 'title', 'img_links'],
    hitsPerPage: 4,
  },
  function searchDone(err, content) {
    if (err) throw err;
    var hits = content.hits;
    console.log(hits);
    $(document).ready(function () {
      hits.forEach(element => {
        $("#buy-listings").append('<div class="col"> <div class="card" style="width:320px"> <img class="card-img-top" src="'+ element["img_links"][0] +'" alt="Card image" style="width:300px; height:300px"> <div class="card-body"> <h4 class="card-title">'+ element["title"] +'</h4>  <a href="'+ 'info.php?index=buy&id=' + element["objectID"] +'" class="btn btn-info">See house</a> </div> </div> </div>');        
      });
    });
  }
);

rentIndex.search(
  {
    query: '',
    attributesToRetrieve: ['objectID', 'title', 'img_links'],
    hitsPerPage: 4,
  },
  function searchDone(err, content) {
    if (err) throw err;
    var hits = content.hits;
    console.log(hits);
    $(document).ready(function () {
      hits.forEach(element => {
        $("#rent-listings").append('<div class="col"> <div class="card" style="width:320px"> <img class="card-img-top" src="'+ element["img_links"][0] +'" alt="Card image" style="width:300px; height:300px"> <div class="card-body"> <h4 class="card-title">'+ element["title"] +'</h4>  <a href="'+ 'info.php?index=rent&id=' + element["objectID"] +'" class="btn btn-info">See house</a> </div> </div> </div>');        
      });
    });
  }
);