<html>
    <head>
        <script src="https://cdn.firebase.com/js/client/2.0.4/firebase.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    </head>
    <body>  
        NEST API TEST
        <script>
            
            
            
            AuthorizationURL = "https://home.nest.com/login/oauth2?client_id=e6f605b6-a00b-458d-90d0-d9d22632914e&state=STATE";
            
            $.get(AuthorizationURL,{},function(data){
	            console.log(data);
            });
            
            code = "Q697DFA5";
            
            AccesTokenUrl = "https://api.home.nest.com/oauth2/access_token";
            donnee = {
	        	"client_id": "e6f605b6-a00b-458d-90d0-d9d22632914e",
	        	"code": code,
	        	"client_secret":"3B2kRsvP3qGe2i27JYrZ9uAuA",
	        	"grant_type":"authorization_code"
	        };
            $.post(AccesTokenUrl,donnee,function(data){
	            console.log(data);
            });
            
            
            /*var myFirebaseRef = new Firebase(AccesTokenUrl);
            console.log(myFirebaseRef);
            
            //read
            myFirebaseRef.child("location/city").on("value", function(snapshot) {
              alert(snapshot.val());  // Alerts "San Francisco"
            });
            
            // Retrieve new posts as they are added to Firebase
            ref.on("child_added", function(snapshot) {
              var newPost = snapshot.val();
              console.log("Author: " + newPost.author);
              console.log("Title: " + newPost.title);
            });
            
            //write
            myFirebaseRef.set({
              title: "Hello World!",
              author: "Firebase",
              location: {
                city: "San Francisco",
                state: "California",
                zip: 94103
              }
            });
            */
            //firebase info
            //https://www.firebase.com/docs/web/guide/retrieving-data.html
        </script>
    </body>
</html>