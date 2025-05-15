<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>iSave - Libmanan Contact Tracing</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/style.js') }}" defer></script>
        <script src="{{ asset('js/styleNavHome.js') }}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel = "icon" href = "{{asset('images/system/logo.png')}}" type = "image/x-icon">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    </head>
    <body>
        
        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light custom-nav sticky-top fix-top" id="navbar">
                <div class="container">
                <a class="navbar-brand mr-2" href="/"><img id="image-logo" style="height: 70px; width:70px;" src="images/system/logo.png"></a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"><span class="small navbar-toggler-icon "></span></button>
                    <div class="collapse navbar-collapse " id="collapsibleNavbar">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link active" href="/" id="nav-home"> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#transmission" id="nav-transmission"> About Covid</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#symptoms" id="nav-symptoms"> Symptoms</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#prevent" id="nav-prevent"> Prevention</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#note" id="nav-contact"> Contact Us</a>
                        </li>
                        
                        </ul>
                        <ul class="navbar-nav justify-content-end">
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link  dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Covid-19 Tracking
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="/citizen/map">Covid-19 Case</a>
                                    <a class="dropdown-item" href="/citizen/tracking">My Check-in</a>
    
                                  </div>
                            </li> -->
                            <li class="nav-item ">
                                <a class="nav-link" href="/citizen/map" id="nav-symptoms"> Covid-19</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="/citizen/tracking" id="nav-symptoms"> Tracking</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="/citizen/i-card" id="nav-symptoms"> I-Card</a>
                            </li>
                        </ul>


                    </div>
                </div>
            </nav>


            <section id="banner" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <h1 class="banner-title">
                                COVID-19 Contact Tracing System
                            </h1>
                            <p class="banner-title-sub1">A Municipality of Libmanan Contact Tracing App</p>
                            <p class="banner-title-sub2">Cooperation is the to fight the pandemic Covid-19</p>
                            <p class="banner-title-sub3"><em> Register to help the community of Libmanan a better place.</em></p>
                            
                            
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mx-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-10">
                                        <a href="{{url('/eula')}}" class="btn btn-primary btn-block btn-lg banner-btn banner-btn2 rounded-pill">REGISTER AS INDIVIDUAL <br /> (Libmanan Residents & Visitors)</a>
                                        </div>
                                    </div>
                                    {{-- <div class="row justify-content-center">
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-10">
                                            <a href="/establishment" class="btn btn-primary btn-block btn-lg banner-btn rounded-pill">REGISTER AS ESTABLISHMENT<br /> (Libmanan Establishments)</a>
                                        </div>
                                    </div> --}}
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-10">
                                            <a href="#" class="btn btn-light btn-block btn-lg banner-btn banner-btn1 rounded-pill">LIKE OUR FACEBOOK PAGE <br /> (for News & Updates)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 mx-auto">
                            <img src="images/system/banner1.png" class="banner-img" alt="">
                        </div>
                    <div
                </div>
            </section>

            <section id="transmission" class="section">
                <div class="container">
                    <div class="row mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                            <div class="transmisstion mb-4">
                                <h3>HOW CORONAVIRUS IS SPREAD</h3>
                                <h1>TRANSMISSION OF COVID-19</h1>
                                <div class="row justify-content-center">
                                    <div class="col-xl-7 col-lg-8 col-md-10 col-sm-12 col-12">
                                        <p>Because it's a new illness, we do not know exactly how coronavirus spreads from person to person. Similar viruses are spread in cough droplets.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5 mb-5 justify-content-center">
                                <div class="col-md-4 col-sm-12  col-10 mb-2">
                                    <div class="card transmisstion-card">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 col-sm-6 justify-content-center align-self-center">
                                            <img src="images/system/spread-a.png" class="card-img-top" alt="...">
                                            <div class="transmission-img-box"> </div>
                                            </div>
                                            <div class="col-md-12 col-sm-6">
                                            <div class="card-body">
                                                <h5 class="card-title transmission-title-card">Person-to-person spread as close contact with infected</h5>
                                                <p class="card-text text-justify">The coronavirus is thought to spread mainly from person to person. This can happen between people who are in close contact with one another.</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12  col-10 mb-2">
                                    <div class="card transmisstion-card">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 col-sm-6 justify-content-center align-self-center">
                                            <img src="images/system/spread-b.png" class="card-img-top" alt="...">
                                            <div class="transmission-img-box"> </div>
                                            </div>
                                            <div class="col-md-12 col-sm-6">
                                            <div class="card-body">
                                                <h5 class="card-title transmission-title-card">Touching or contact with infected surfaces or objects</h5>
                                                <p class="card-text text-justify">A person can get COVID-19 by touching a surface or object that has the virus on it and then touching their own mouth, nose, or possibly their eyes.</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12  col-10 mb-2">
                                    <div class="card transmisstion-card">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 col-sm-6 justify-content-center align-self-center">
                                            <img src="images/system/spread-c.png" class="card-img-top" alt="...">
                                            <div class="transmission-img-box"> </div>
                                            </div>
                                            <div class="col-md-12 col-sm-6">
                                            <div class="card-body">
                                                <h5 class="card-title transmission-title-card">Droplets that from infected person coughs or sneezes</h5>
                                                <p class="card-text text-justify">The coronavirus is thought to spread mainly from person to person. This can happen between people who are in close contact with one another.</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 justify-content-center">
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10 col-12">
                            <a href="#" class="btn btn-primary btn-block btn-lg rounded-pill btn-tranmission">Have a question about spreading <span class="far fa-question-circle"></span></a>
                        </div>
                    </div>
                </div>
            </section>

            <section id="symptoms" class="section">
                <div class="container">
                    <div class="row mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                            <div class="symptoms">
                                <h3>WHAT ARE THE SYMPTOMS OF COVID-19?</h3>
                                <h1>SYMPTOMS OF CORONAVIRUS</h1>
                                <div class="row justify-content-center">
                                    <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 col-12">
                                        <p>The most common symptoms of COVID-19 are fever, tiredness, and dry cough. Some patients may have aches and pains, nasal congestion, runny nose, sore throat or diarrhea. These symptoms are usually mild and begin gradually. Also the symptoms may appear 2-14 days after exposure.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-xl-4 col-lg-4 col-md-4">
                                    <div class="card card-symptoms">
                                        <div class="row no-gutters">
                                          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-4 col-4 justify-content-center align-self-center">
                                            <img src="images/system/symptom-a.png" class="symptoms-img rounded-circle" alt="...">
                                          </div>
                                          <div class="col-xl-8 col-lg-8 col-md-12 col-sm-8 col-8">
                                            <div class="card-body symptoms-card-body">
                                                <h5 class="symptoms-card-title">Fever</h5>
                                                <p class="card-text symptoms-card-text"><strong>High Fever –</strong>  this means you feel hot to touch on your chest or back (you do not need to measure your temperature). It is a common sign and also may appear in 2-10 days if you affected.</p>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4">
                                    <div class="card card-symptoms">
                                        <div class="row no-gutters">
                                          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-4 col-4 justify-content-center align-self-center">
                                            <img src="images/system/symptom-b.png" class="symptoms-img rounded-circle" alt="...">
                                          </div>
                                          <div class="col-xl-8 col-lg-8 col-md-12 col-sm-8 col-8">
                                            <div class="card-body symptoms-card-body">
                                                <h5 class="symptoms-card-title">Cough</h5>
                                                <p class="card-text symptoms-card-text"><strong>Continuous cough –</strong>  this means coughing a lot for more than an hour, or 3 or more coughing episodes in 24 hours (if you usually have a cough, it may be worse than usual).</p>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4">
                                    <div class="card card-symptoms">
                                        <div class="row no-gutters">
                                          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-4 col-4 justify-content-center align-self-center">
                                            <img src="images/system/symptom-c.png" class="symptoms-img rounded-circle" alt="...">
                                          </div>
                                          <div class="col-xl-8 col-lg-8 col-md-12 col-sm-8 col-8">
                                            <div class="card-body symptoms-card-body">
                                                <h5 class="symptoms-card-title">Shortness of breath</h5>
                                                <p class="card-text symptoms-card-text"><strong>Difficulty breathing –</strong> Around 1 out of every 6 people who gets COVID-19 becomes seriously ill and develops difficulty breathing or shortness of breath.</p>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <section id="prevent" class="section">
                <div class="container">
                    <div class="row mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                            <div class="prevent">
                                <h3>HOW TO PROTECT YOURSELF?</h3>
                                <h1>PREVENTION & ADVICE</h1>
                                <div class="row justify-content-center">
                                    <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 col-12">
                                        <p>There is currently no vaccine to prevent coronavirus disease 2019 (COVID-19). The best way to prevent illness is to avoid being exposed to this virus. Stay aware of the latest information on the COVID-19 outbreak, available on the WHO website and through your national and local public health authority.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-3 col-xl-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-prevent">
                                        <div class="row no-gutters">
                                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-4 justify-content-center align-self-center">
                                            <img src="images/system/advice-a.png" class="card-img rounded-circle prevent-img" alt="...">
                                          </div>
                                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-8">
                                            <div class="card-body prevent-card-body">
                                              <h5 class="card-title prevent-card-title">Wash your hands frequently</h5>
                                              <p class="card-text prevent-card-text">Regularly and thoroughly clean your hands with an alcohol-based hand rub or wash them with soap and water for at least 20 seconds.</p> 
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-xl-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-prevent">
                                        <div class="row no-gutters">
                                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-4 justify-content-center align-self-center">
                                            <img src="images/system/advice-b.png" class="card-img rounded-circle prevent-img" alt="...">
                                          </div>
                                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-8">
                                            <div class="card-body prevent-card-body">
                                              <h5 class="card-title prevent-card-title">Maintain social distancing</h5>
                                              <p class="card-text prevent-card-text">Maintain at least 1 metre (3 feet) distance between yourself & anyone who is coughing or sneezing. If you are too close, get chance to infected.</p> 
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-xl-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-prevent">
                                        <div class="row no-gutters">
                                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-4 justify-content-center align-self-center">
                                            <img src="images/system/advice-c.png" class="card-img rounded-circle prevent-img" alt="...">
                                          </div>
                                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-8">
                                            <div class="card-body prevent-card-body">
                                              <h5 class="card-title prevent-card-title">Avoid touching face</h5>
                                              <p class="card-text prevent-card-text">Hands touch many surfaces and can pick up viruses. So, hands can transfer the virus to your eyes, nose or mouth and can make you sick.</p> 
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-xl-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-prevent">
                                        <div class="row no-gutters">
                                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-4 justify-content-center align-self-center">
                                            <img src="images/system/advice-d.png" class="card-img rounded-circle prevent-img" alt="...">
                                          </div>
                                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-8">
                                            <div class="card-body prevent-card-body">
                                              <h5 class="card-title prevent-card-title">Practice respiratory hygiene</h5>
                                              <p class="card-text prevent-card-text">Maintain good respiratory hygiene as covering your mouth & nose with your bent elbow or tissue when cough or sneeze.</p> 
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                

                                

                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                            <div class="prevent">
                                <h3>Follow steps to wash hands</h3>
                            </div>
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                                    <div class="card card-prevent1">
                                        <div class="card-body text-center">
                                            <img src="images/system/hand-a.png" class="card-img-top rounded-circle prevent-img-hand text-center" alt="...">
                                            <h5 class="card-title prevent-card-title1">Soap on Hand</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                                    <div class="card card-prevent1">
                                        <div class="card-body text-center">
                                            <img src="images/system/hand-b.png" class="card-img-top rounded-circle prevent-img-hand text-center" alt="...">
                                            <h5 class="card-title prevent-card-title1">Palm to Palm</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                                    <div class="card card-prevent1">
                                        <div class="card-body text-center">
                                            <img src="images/system/hand-c.png" class="card-img-top rounded-circle prevent-img-hand text-center" alt="...">
                                            <h5 class="card-title prevent-card-title1">Between Fingers</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                                    <div class="card card-prevent1">
                                        <div class="card-body text-center">
                                            <img src="images/system/hand-d.png" class="card-img-top rounded-circle prevent-img-hand text-center" alt="...">
                                            <h5 class="card-title prevent-card-title1">Back to Hands</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                                    <div class="card card-prevent1">
                                        <div class="card-body text-center">
                                            <img src="images/system/hand-e.png" class="card-img-top rounded-circle prevent-img-hand text-center" alt="...">
                                            <h5 class="card-title prevent-card-title1">Clean with Water</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                                    <div class="card card-prevent1">
                                        <div class="card-body text-center">
                                            <img src="images/system/hand-f.png" class="card-img-top rounded-circle prevent-img-hand text-center" alt="...">
                                            <h5 class="card-title prevent-card-title1">Focus on Wrist</h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                    </div>

                </div>
            </section>

            <section id="note">
               <div class="container">
                   <div class="row">
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                           <dl class="row mt-5 note-body">
                               <dt class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h1 class="text-left"> <span class="fas fa-exclamation-triangle"></span></h1>
                               </dt>
                               <dd class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-9">
                                    <p> <strong>Stay at home and call your doctor: </strong> <em>If you think you have been exposed to COVID-19 and develop a fever and any symptoms, such as cough or difficulty breathing, call your healthcare provider as soon as possible for medical advice.</em></p>
                               </dd>
                           </dl>

                           <div class="row mb-4 note-detail">
                               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1152.4608596318071!2d123.05991550686642!3d13.694157017994103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a21e369b750f49%3A0x27cdfde4ab0d2ad1!2sLibmanan%20Municipal%20Hall!5e0!3m2!1sen!2sph!4v1599167745622!5m2!1sen!2sph" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                               </div>
                               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3 note-contact">
                                    <h4> <span class="fa fa-at"></span> Email : email@domain.com.ph</h4>
                                    <h4> <span class="fa fa-phone"></span> Phone : +(63) 912 345 67890</h4>
                                    <h4> <span class="fa fa-map-marker-alt"></span> J. Hernandez Street, Libmanan, <br/> Camarines Sur, Philippines 4407</h4 >
                               </div>


                            
                           </div>

   

                       </div>
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                <div class="message-back mt-5 mb-5">
                                    <div class="message-title">
                                        <h1>Got questions?</h1>
                                        <h3>Please message us.</h3>
                                        <p>Leave us a message and we'll get back as soon as possible.</p>
                                    </div>

                                    <div class="message-title1">
                                        <form action="">
                                            <div class="form-group required row">
                                                    <label for="fullname" class="col-sm-12 col-form-label">First name :</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="fullname" required="" placeholder="Enter your first name here.">
                                                    <div class="invalid-feedback"><span class="fa fa-exclamation"></span> Required: Fill the field with your first name.</div>
                                                </div>
                                            </div>
        
                                            <div class="form-group required row">
                                                    <label for="fullname" class="col-sm-12 col-form-label">Last name :</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="fullname" required="" placeholder="Enter your last name here.">
                                                    <div class="invalid-feedback"><span class="fa fa-exclamation"></span> Required: Fill the field with your last name.</div>
                                                </div>
                                            </div>
        
                                            <div class="form-group required row">
                                                    <label for="fullname" class="col-sm-12 col-form-label">Email :</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="fullname" required="" placeholder="Enter your email address here..">
                                                    <div class="invalid-feedback"><span class="fa fa-exclamation"></span> Required: Fill the field with your email <address></address>.</div>
                                                </div>
                                            </div>
        
                                            <div class="form-group required row mb-4">
                                                    <label for="address" class="col-sm-12 col-form-label">Message :</label>
                                                <div class="col-sm-12">
                                                    <textarea type="text" rows="3" cols="50" class="form-control textAreaAddress" id="address" placeholder="Enter your message here."></textarea>
                                                    <div class="invalid-feedback"><span class="fa fa-exclamation"></span> Required: Fill the field with your message.</div>
                                                </div>
                                            </div>

                                            <button class="btn btn-light rounded-pill btn-block btn-lg btn-note-msg">Submit</button>
                                            
                                        </form>
                                    </div>

                                </div>


                                

                                
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </section>

            <section id="footer">
                <div class="container">
                    <div class="row pt-5">
                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-8 col-12">
                            <div class="row mb-3">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <a href="#"> <img src="images/system/logo-foot.png" alt=""></a>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 foot-description">
                                    <p>This website is for Munifipality of Libmanan Contact Tracing App Registration and advice about coronavirus (COVID-19), how to prevent and protect yourself from disease.</p>
                                    <p>Learn about the government response to coronavirus on our social media accounts.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
                            <h6 class="foot-link-title">QUICK LINK</h6>
                            <ul class="foot-link-links">
                                <li><a href="#transmission">About Covid</a></li>
                                <li><a href="#symptoms">Symptoms</a></li>
                                <li><a href="#prevent">Prevent</a></li>
                                <li><a href="#note">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <h6 class="foot-link-title">HELPFULL LINK</h6>
                            <ul class="foot-link-links">
                                <li><a href="#">Municipality of Libmanan</a></li>
                                <li><a href="#">DOH Covid-19 Tracker</a></li>
                                <li><a href="#">DOH Bicol</a></li>
                                <li><a href="#">DILG Region V</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
                            <h6 class="foot-link-title">IMPORTANT LINK</h6>
                            <ul class="foot-link-links">
                                <li><a href="#">WHO Website</a></li>
                                <li><a href="#">DOH Website</a></li>
                                <li><a href="#">DOH CHD Website</a></li>
                                <li><a href="#">IATF Website</a></li>
                            </ul>
                        </div>
                    </div>

      

                    <div class="row pb-3 footer-last">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <p>© 2020 i-Safe Libmanan. Template Made by <a href="https://www.facebook.com/mackyhoho">Jay Mark A. Borja</a> </p>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 d-flex justify-content-md-end">
                                    <a href="#" class="privacy">Privacy Policy</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-justify foot-desclaimer">
                            <p>Disclaimer: We hope you find the information presented on this website useful. This website is for general information and raise awareness of (2019-nCoV) only. If you have any doubt please verify from respective site.</p>
                        </div>
                    </div>
                </div>
            </section>
            
        </div>
        

        


    </body>
</html>
