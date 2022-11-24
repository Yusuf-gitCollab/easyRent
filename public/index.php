<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>easyRent | Find Rental Property</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- update the version number as needed -->
    <script defer src="/__/firebase/9.13.0/firebase-app-compat.js"></script>
    <!-- include only the Firebase features as you need -->
    <script defer src="/__/firebase/9.13.0/firebase-auth-compat.js"></script>
    <script defer src="/__/firebase/9.13.0/firebase-database-compat.js"></script>
    <script defer src="/__/firebase/9.13.0/firebase-firestore-compat.js"></script>
    <script defer src="/__/firebase/9.13.0/firebase-functions-compat.js"></script>
    <script defer src="/__/firebase/9.13.0/firebase-messaging-compat.js"></script>
    <script defer src="/__/firebase/9.13.0/firebase-storage-compat.js"></script>
    <script defer src="/__/firebase/9.13.0/firebase-analytics-compat.js"></script>
    <script defer src="/__/firebase/9.13.0/firebase-remote-config-compat.js"></script>
    <script defer src="/__/firebase/9.13.0/firebase-performance-compat.js"></script>
    <!-- 
      initialize the SDK after all desired features are loaded, set useEmulator to false
      to avoid connecting the SDK to running emulators.
    -->
    <script defer src="/__/firebase/init.js?useEmulator=true"></script>
  </head>
  <body>
    <nav>
      <div class="container">
        <div class="navigation">
          <a href="http://localhost/easyRent/public/index.php"><h1 class="logo">easyRent</h1></a>
          <ul class="nav-menu">
            <li><a href="">Find Rent/PG</a></li>
            <li><a href="">Coworking</a></li>
            <li><a href="">Post Property</a></li>
            
            <?php 
              require('../server/connection.php');
              if(isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) :
            ?>
              <li>
                <a href="">
                  <?php 
                    $query = mysqli_query($con, "SELECT * FROM `users` WHERE `email_id`='$_SESSION[username]'");
                    $fetch = mysqli_fetch_array($query);
                    $str = $fetch['username'];
                    $str=substr($str, 0, strpos($str, ' '));
                    echo"<i class='fa-solid fa-user'></i>"."$str";
                   ?>
            
                </a>
              </li>
              <li>
                <a href="../server/logout.php" class="btn" style="color: white;">Log out</a>
              </li>
            <?php else: ?>
              <li><a href="./pages/login.html" class="btn" style="color: white">Sign in</a></li>
            <?php endif; ?>
          </ul>
          
        </div>
      </div>
    </nav>
    <header>
      <div class="container">
        <div class="banner-wrapper">
          <h1 class="heading">Find Your Place of Comfort</h1>
          <h2 class="tagline">Find home to rent or buy, PG and shared rooms</h2>
          <form>
            <div class="card">
              <div class="option-div">
                <button type="button" role="tab" data-state="active" class="tab">Coworking</button>
                <button type="button" role="tab" data-state="" class="tab">Paying Guest</button>
                <button type="button" role="tab" data-state="" class="tab">Rent</button>
              </div>
              <div class="search-div">
                <form role="search">
                  <div class="search-input-wrapper">
                    <input placeholder="Enter a city, town or postcode">
                    <button type="button" class="btn" id="search-btn"> 
                      <div class="icon-search-text-wrapper">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <p>Search</p>
                      </div>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </form>
        </div>
      </div>
    </header>
    <section>
      <div class="container">
        <div class="register">
          <div class="item1">
            <img src="https://r.zoocdn.com/_next/static/images/Illustration_valuation-7865f6c420b24c9653c25ea47ac38a51.svg" alt="" loading="lazy" class="css-1fyygza eczbk7s0">
          </div>
          <div class="item2">
            <h1>Join the millions getting their Dream house!</h1>
            <p>With easyRent you can search for rented house, paying guest, shared rooms
              in you desired locations and affordable prices from the comfort of your
              house.
            </p>
            <a href="./pages/register.html" class="btn">Register</a>
            <a href="./pages/login.html" class="btn">Sign in</a> 
          </div>
        </div>
      </div>
    </section>
    <!-- showcase section  -->
    <section>
      
      <div class="container">
        <h1 class="highlighted-heading">SERVICES WE OFFER</h1>
        <h1 class="section-heading">Search for rental Property or post if you own one!</h1>
        <div class="showcase-card">
          <div class="showcase-item1">
            <div>
              <img src="https://images.pexels.com/photos/667838/pexels-photo-667838.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="image of a house">
            </div>
          </div>
          <div class="showcase-item2">
              <p>RENT A PG OR CO-LIVING SPACE</p>
              <h1>Paying Guest or Co-living Options</h1>
              <h2>Explore Rented house or Paying guest from all over India</h2>
              <a href="" class="btn">Explore</a> 
          </div>
        </div>

        <div class="showcase-card">
          <div class="showcase-item2">
              <p>Post your property</p>
              <h1>Property owners get free posting<br> when they register</h1>
              <h2>Sell or rent your residential/ commercial property</h2>
              <a href="" class="btn">Post your property for FREE</a> 
          </div>
          <div class="showcase-item1">
            <div>
              <img src="https://images.pexels.com/photos/5668858/pexels-photo-5668858.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="man in front of laptop">
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- ____________________________ top cities section ________________________________________________ -->
    <section>
      <div class="container">
        <div class="top-cites-div">
          <h1 class="highlighted-heading">TOP CITIES</h1>
          <h1 class="section-heading">Paying Guest or Co-working Options in Popular Cities</h1>
          <div class="top-cities-container">
            <div class="top-cities-wrap">
              <ul>
                <li class="top-cities-card">
                  <div class="city-img-div">
                    <img src="https://mediacdn.99acres.com/media1/11848/1/236961707D-1594715125517.jpg" alt="Delhi / NCR Real Estate" title="Delhi / NCR Real Estate" >
                  </div>
                  <div>
                    <p class="city-name">Delhi NCR</p>
                    <p class="caption"> 149,000+ Properites</p>
                  </div>
                </li>
              </ul>
              <ul>
                <li class="top-cities-card">
                  <div class="city-img-div">
                    <img src="https://mediacdn.99acres.com/media1/11848/15/236975527D-1594718126587.jpg" alt="Mumbai Real Estate" title="Mumbai Real Estate" >
                  </div>
                  <div>
                    <p class="city-name">Mumbai</p>
                    <p class="caption"> 109,000+ Properites</p>
                  </div>
                </li>
              </ul>
            </div>

            <div class="top-cities-wrap">
              <ul>
                <li class="top-cities-card">
                  <div class="city-img-div">
                    <img src="https://mediacdn.99acres.com/media1/11846/12/236932009D-1594709336922.jpg" alt="Bangalore Real Estate" title="Bangalore Real Estate" >
                  </div>
                  <div>
                    <p class="city-name">Banglore </p>
                    <p class="caption"> 49,000+ Properites</p>
                  </div>
                </li>
              </ul>
              <ul>
                <li class="top-cities-card">
                  <div class="city-img-div">
                    <img src="https://mediacdn.99acres.com/media1/11848/7/236967665D-1594716318858.jpg" alt="Hyderabad Real Estate" title="Hyderabad Real Estate" >
                  </div>
                  <div>
                    <p class="city-name">Hyderabad</p>
                    <p class="caption"> 19,000+ Properites</p>
                  </div>
                </li>
              </ul>
            </div>

            <div class="top-cities-wrap">
              <ul>
                <li class="top-cities-card">
                  <div class="city-img-div">
                    <img src="https://mediacdn.99acres.com/media1/16807/3/336143474D-1640587363487.jpg" alt="Pune Real Estate" title="Pune Real Estate" >
                  </div>
                  <div>
                    <p class="city-name">Pune</p>
                    <p class="caption"> 78,000+ Properites</p>
                  </div>
                </li>
              </ul>
              <ul>
                <li class="top-cities-card">
                  <div class="city-img-div">
                    <img src="https://mediacdn.99acres.com/media1/11848/13/236973031D-1594717541096.jpg" alt="Kolkata Real Estate" title="Kolkata Real Estate" >
                  </div>
                  <div>
                    <p class="city-name">Kolkata</p>
                    <p class="caption"> 109,000+ Properites</p>
                  </div>
                </li>
              </ul>
            </div>

            <div class="top-cities-wrap">
              <ul>
                <li class="top-cities-card">
                  <div class="city-img-div">
                    <img src="https://mediacdn.99acres.com/media1/11848/1/236961707D-1594715125517.jpg" alt="Delhi / NCR Real Estate" title="Delhi / NCR Real Estate" >
                  </div>
                  <div>
                    <p class="city-name">Guwahati</p>
                    <p class="caption"> 34,000+ Properites</p>
                  </div>
                </li>
              </ul>
              <ul>
                <li class="top-cities-card">
                  <div class="city-img-div">
                    <img src="https://mediacdn.99acres.com/media1/11848/0/236960749D-1594714810078.jpg" alt="Chennai Real Estate" title="Chennai Real Estate">
                  </div>
                  <div>
                    <p class="city-name">Chennai</p>
                    <p class="caption"> 29,000+ Properites</p>
                  </div>
                </li>
              </ul>
            </div>
            
          </div>
        </div>
      </div>
    </section>
    <footer>
      <div class="container">
        <div class="footer">
          <div class="footer-col">
            <ul>
              <li>For Sale</li>
              <li>New Homes</li>
              <li>Commercial Properties</li>
              <li>Overseas</li>
              <li>Find Estate Agent</li>
            </ul>
          </div>

          <div class="footer-col">
            <ul>
              <li>To Rent</li>
              <li>Commercial Properties to rent</li>
              <li>Find Letting Agents</li>
            </ul>
          </div>

          <div class="footer-col">
            <ul>
              <li>News and guides</li>
              <li>Help to Buy</li>
              <li>Shared Ownership</li>
              <li>Buying guides</li>
              <li>Selling guides</li>
              <li>Renting guides</li>
            </ul>
          </div>

          <div class="footer-col">
            <ul>
              <li>Contact Us</li>
              <li>Toll Free - 0000 00 00000</li>

              <li>Monday - Saturday (9:00AM to 11:00PM IST)</li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <div class="copyright">
      <div class="container">
        Made by Harsh and Nabamita
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const loadEl = document.querySelector('#load');
        // // 🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥
        // // The Firebase SDK is initialized and available here!
        //
        // firebase.auth().onAuthStateChanged(user => { });
        // firebase.database().ref('/path/to/ref').on('value', snapshot => { });
        // firebase.firestore().doc('/foo/bar').get().then(() => { });
        // firebase.functions().httpsCallable('yourFunction')().then(() => { });
        // firebase.messaging().requestPermission().then(() => { });
        // firebase.storage().ref('/path/to/ref').getDownloadURL().then(() => { });
        // firebase.analytics(); // call to activate
        // firebase.analytics().logEvent('tutorial_completed');
        // firebase.performance(); // call to activate
        //
        // // 🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥

        try {
          let app = firebase.app();
          let features = [
            'auth', 
            'database', 
            'firestore',
            'functions',
            'messaging', 
            'storage', 
            'analytics', 
            'remoteConfig',
            'performance',
          ].filter(feature => typeof app[feature] === 'function');
          loadEl.textContent = `Firebase SDK loaded with ${features.join(', ')}`;
        } catch (e) {
          console.error(e);
          loadEl.textContent = 'Error loading the Firebase SDK, check the console.';
        }
      });
    </script>
    <script type="application/json" src="./script.js"></script>
  </body>
</html>
