<script type="text/javascript">
		// var locations = [
		//   ['ZALKA',33.9029094, 35.5753319, 4], //CORRECT
		//   ['ABC DBAYEH', 33.926317, 35.588565, 5], //CORRECT
		//   ['ABC ACHRAFIEH', 33.888506, 35.519450, 3], // 33.888506, 35.519450
		//   ['ABC VERDUN, LO', 33.884296, 35.484946, 2], // 33.884296, 35.484946
		//   ['LOS ANGELES', -31.80010128657071, 151.28747820854187, 2],
		//   ['ABC VERDUN', -29.80010128657071, 151.28747820854187, 2],
		//   ['MTAYLEB', -33.950198, 151.259302, 1]

			// ['ABC DBAYEH', -33.923036, 151.259052, 5],
			// ['ABC', -34.028249, 151.157507, 3],
			// ['ABC VERDUN, LO', -33.80010128657071, 151.28747820854187, 2],
			// ['LOS ANGELES', -31.80010128657071, 151.28747820854187, 2],
			// ['ABC VERDUN', -29.80010128657071, 151.28747820854187, 2],
			// ['MTAYLEB', -33.950198, 151.259302, 1]
		// ];

		// var map = new google.maps.Map(document.getElementById('map'), {
		//   zoom: 14,
		//   center: new google.maps.LatLng(33.854721,35.862286),
		//   mapTypeId: google.maps.MapTypeId.ROADMAP
		// });

		// var infowindow = new google.maps.InfoWindow();

		// var marker, i;

		// for (i = 0; i < locations.length; i++) {  
		//   marker = new google.maps.Marker({
		//     position: new google.maps.LatLng(locations[i][1], locations[i][2]),
		//     map: map
		//   });

		//   google.maps.event.addListener(marker, 'click', (function(marker, i) {
		//     return function() {
		//       infowindow.setContent(locations[i][0]);
		//       infowindow.open(map, marker);
		//     }
		//   })(marker, i));
		// }
</script>
<div  class="wideview" id="googleMap" style="height:305px;"></div>
<script>
function myMap() {
	var mapProp= {
		center:new google.maps.LatLng(33.892801614213795, 35.51457604976901),
		zoom:3,
		styles: [
    {
        "featureType": "all",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#8ab4f8"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "gamma": 0.01
            },
            {
                "lightness": 20
            },
            {
                "weight": "1.39"
            },
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "weight": "0.96"
            },
            {
                "saturation": "9"
            },
            {
                "visibility": "on"
            },
            {
                "color": "#000000"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": 0
            },
            {
                "saturation": "0"
            },
            {
                "color": "#f6f2e8"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "saturation": 0
            },
            {
                "visibility": "off"
            },
            {
                "hue": "#ff0000"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": 20
            },
            {
                "saturation": -20
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": 10
            },
            {
                "saturation": -30
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#3F4958"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "saturation": 25
            },
            {
                "lightness": 25
            },
            {
                "weight": "0.01"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "lightness": 0
            }
        ]
    }
]};

	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var markerwaterfrontcity = new google.maps.Marker({
		position: new google.maps.LatLng(33.892801614213795, 35.51457604976901),
		map: map
	});

	var markercyprus = new google.maps.Marker({
		position: new google.maps.LatLng(25.411683110516524, 55.45162768457016),
		map: map
	});
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJdo0JXQhj0tQBlA6zV0R-C2PYWbn2fBA&callback=myMap"></script>