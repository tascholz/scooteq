<script type="text/javascript">
    var routes = <?php echo json_encode($routes) ?>;
    var destinations = <?php echo json_encode($destinations); ?>;


    function showRoute(key) {
        cardContainer = document.getElementById('test');
        
        
        while (cardContainer.hasChildNodes()) {
            cardContainer.removeChild(cardContainer.lastChild);
        }

        routeTitle = document.createElement('h5');
        routeTitle.innerText = "Route " + key;
        cardContainer.appendChild(routeTitle);

        routes[key].forEach((destination) => {
            createRouteCard(destination);
        });
    }

    function getRouteText(id){
        destination = destinations[id-1];
        if(destination.diff > 0){
            return "Abholen: " + destination.diff;
        }
        return "Abstellen: " + Math.abs(destination.diff);
    }

    let createRouteCard = (destination) => {
        let card = document.createElement('div');
        card.className = 'card shadow cursor-pointer';

        let cardBody = document.createElement('div');
        cardBody.className = 'card-body';

        let title = document.createElement('h5');
        title.innerText = destination.name;
        title.className = 'card-title';

        let text = document.createElement('p');
        text.innerText = getRouteText(destination.id);
        text.className = 'card-text';

        cardBody.appendChild(title);
        cardBody.appendChild(text);
        card.appendChild(cardBody);
        cardContainer.appendChild(card);
    }
    </script>