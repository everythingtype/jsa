var nymarker;
var shanghaimarker;
var dubaimarker;


// When the window has finished loading create our google map below
google.maps.event.addDomListener(window, 'load', initMap);

function initMap() {

 // If document (your website) is wider than 480px, isDraggable = true, else isDraggable = false
   var isDraggable = window.innerWidth > 480 ? true : false;

	// NY
	var nymap = new google.maps.Map(document.getElementById('nymap'), {
		draggable: isDraggable,
		scrollwheel: false,
		zoom: 15,
		mapTypeControl: false,
		streetViewControl: false,
		center: new google.maps.LatLng(40.7374296, -73.9921085),
		styles: [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]
	});

  nymarker = new google.maps.Marker({
    map: nymap,
    icon: 'http://joelsandersarchitect.com/wp-content/uploads/2016/04/mapmarker.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    position: new google.maps.LatLng(40.7374296, -73.9921085)
  });
  nymarker.addListener('click', toggleNyBounce);


	// Shanghai
  var shanghaimap = new google.maps.Map(document.getElementById('shanghaimap'), {
	draggable: isDraggable,
	scrollwheel: false,
    zoom: 15,
	mapTypeControl: false,
	streetViewControl: false,
    center: new google.maps.LatLng(40.7374296, -73.9921085),
    styles: [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]
  });

  shanghaimarker = new google.maps.Marker({
    map: shanghaimap,
    icon: 'http://joelsandersarchitect.com/wp-content/uploads/2016/04/mapmarker.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    position: new google.maps.LatLng(40.7374296, -73.9921085)
  });
  shanghaimarker.addListener('click', toggleShanghaiBounce);


	// Dubai
  var dubaimap = new google.maps.Map(document.getElementById('dubaimap'), {
	draggable: isDraggable,
	scrollwheel: false,
    zoom: 15,
	mapTypeControl: false,
	streetViewControl: false,
    center: new google.maps.LatLng(40.7374296, -73.9921085),
    styles: [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]
  });

  dubaimarker = new google.maps.Marker({
    map: dubaimap,
    icon: 'http://joelsandersarchitect.com/wp-content/uploads/2016/04/mapmarker.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    position: new google.maps.LatLng(40.737874, -73.987902)
  });
  dubaimarker.addListener('click', toggleDubaiBounce);


}

function toggleNyBounce() {
  if (nymarker.getAnimation() !== null) {
    nymarker.setAnimation(null);
  } else {
    nymarker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

function toggleDubaiBounce() {
  if (dubaimarker.getAnimation() !== null) {
    dubaimarker.setAnimation(null);
  } else {
    dubaimarker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

function toggleShanghaiBounce() {
  if (shanghaimarker.getAnimation() !== null) {
    shanghaimarker.setAnimation(null);
  } else {
    shanghaimarker.setAnimation(google.maps.Animation.BOUNCE);
  }
}