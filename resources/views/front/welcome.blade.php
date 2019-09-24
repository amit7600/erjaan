@extends('layout.front.content')

{{-- Page content --}}
@section('inner_body')
<!-- ABOUT 
            =================-->
             <!-- Top Banner Sec -->
    <section id="topBanner" class="topBanner">
        <div class="container">
            <div class="row">
                <div class="topBnrTxt">
                    <h1 class="wow bounceIn" data-wow-duration="600ms">Digital Surveys Solutions</h1>
                    <p class="wow bounceIn" data-wow-duration="900ms">Erjaan is a Saudi company specializing in cloud smart surveys solutions aiming to help organizations
                        in business , healthcare and education sectors to make smarter decisions to drive growth by collecting
                        and analyzing the right data from the right sources.</p>
                    <p class="header_sub">We are proud of our solutions</p>
                    <ul class="buttons">
                        <li>
                            <a href="#customerexperience" class="downloadButtons scrollto">
                                <img src="{{asset('/erjaanhtml/img/emploex.png')}}" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#employeeengagement" class="downloadButtons scrollto">
                                <img src="{{asset('/erjaanhtml/img/customerex.png')}}" alt="">
                            </a>
                        </li>
                    </ul>

                </div>
                <!--  <div class="scrollDown">
                    <a href="#howItWork">
                        <img src="img/scrollmouse.png" alt="">
                    </a>
                </div>-->
            </div>
        </div>

        <div class="btmArwScrl">
            <a href="#howitworks" class="scrollto">
                <i></i>
            </a>
        </div>
    </section>

    <!-- HowItWorks Section Start -->
    <div class="section HowItWorks howitworks" id="howitworks">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="work_title wow fadeInUp animated animated" data-wow-duration="600ms">
                        <h2 class="font-37">how
                            <strong>it works</strong>
                        </h2>
                        <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                    </div>
                    <p class="text-center font-20 work_para">Erjaan application helps organizations to make the right decisions by collecting and analyzing data from
                        their correct sources through a smart survey solution designed to help decision makers get information
                        and link it to performance indicatorsWhether you are looking to measure customer satisfaction and
                        give voice to the customer or you are looking to raise the efficiency of employees by measuring indicators
                        of engagement and productivity

                    </p>
                </div>
            </div>

            <div class="row featuire_panel text-center">
                <div class="col-sm-3 col-xs-6 no_padding">
                    <div class="borderBot">
                        <div class="border">
                            <img src="{{asset('/erjaanhtml/img/howit-1.png')}}" alt="">
                        </div>
                    </div>
                    <div class="triangle"></div>
                    <div class="text">
                        <h6>BUILD</h6>
                        <p>Build the surery you need to user our templates which built with industry know how</p>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 no_padding">
                    <div class="borderBot">
                        <div class="border">
                            <img src="{{asset('/erjaanhtml/img/howit-2.png')}}" alt="">
                        </div>
                    </div>
                    <div class="triangle"></div>
                    <div class="text">
                        <h6>SEND</h6>
                        <p>Use Erjaan built-in tools to trigger your survey automatically our manually</p>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 no_padding">
                    <div class="borderBot">
                        <div class="border">
                            <img src="{{asset('/erjaanhtml/img/howit-3.png')}}" alt="">
                        </div>
                    </div>
                    <div class="triangle"></div>
                    <div class="text">
                        <h6>COLLECT</h6>
                        <p>Allow your clients to submit their feedback from their smart phones anytimg, anywhere</p>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 no_padding">
                    <div class="borderBot">
                        <div class="border">
                            <img src="{{asset('/erjaanhtml/img/howit-4.png')}}" alt="">
                        </div>
                    </div>
                    <div class="triangle"></div>
                    <div class="text">
                        <h6>Analyze</h6>
                        <p>Immediate analyzing and reporting for surverys with visual data representation</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- HowItWorks Section End -->

    <!-- BuildWith Section Start -->
    <div class="BuildWith clearfix">
        <div class="outer-width">
            <div class="itemWrap">
                <div class="item block-6 leftSide text-center wow fadeInLeft animated animated" data-wow-duration="600ms">
                    <div class="text">
                        <div class="title wow fadeInUp animated animated" data-wow-duration="600ms">
                            <h2>Built with everyone in mind</h2>
                            <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                        </div>
                        <p class="leftpara">Erjaan is used by businesses, educational institutions, students, and healthcare provider to build,
                            send , collect and analyze data every day.</p>
                    </div>
                </div>
                <div class="item block-6 rightSide text-center wow fadeInRight animated animated" data-wow-duration="600ms">
                    <div class="text">
                        <div class="title">
                            <h2>solutions & industries</h2>
                            <img src="{{asset('/erjaanhtml/img/title-white.png')}}" alt="">
                        </div>
                        <p class="rightpara">Take advantage of powerful survey solution adapted just for you, and make the leap from survey maker
                            to research pro. Whether you’re a healthcare professional or you want to evaluate your employee
                            satisfaction, check out our industries and solutions below to see how Erjaan can go to work for
                            you.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BuildWith Section End -->

    <!-- Business Section Start -->
    <div class="section Business">
        <div class="container">
            <div class="row wow fadeInUp animated animated" data-wow-duration="1200ms">
                <div class="col-sm-4">
                    <div class="content">
                        <div class="itemImg">
                            <div class="img">
                                <img src="{{asset('/erjaanhtml/img/busn-1.png')}}" alt="">
                            </div>
                            <h6>business</h6>
                        </div>
                        <div class="innerItem">
                            <p>Customer satisfaction,
                                <br>experience and feedback</p>
                        </div>
                        <div class="innerItem">
                            <p>Make research</p>
                        </div>
                        <div class="innerItem">
                            <p>Employee engagement
                                <br>and development</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="content">
                        <div class="itemImg">
                            <div class="img">
                                <img src="{{asset('/erjaanhtml/img/busn-2.png')}}" alt="">
                            </div>
                            <h6>healthcare</h6>
                        </div>
                        <div class="innerItem">
                            <p>Patient experience and
                                <br>satifaction</p>
                        </div>
                        <div class="innerItem">
                            <p>Medical and personal stuff
                                <br>engagement and development</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="content">
                        <div class="itemImg">
                            <div class="img">
                                <img src="{{asset('/erjaanhtml/img/newicon.PNG')}}" alt="">
                            </div>
                            <h6>education</h6>
                        </div>
                        <div class="innerItem">
                            <p>Student parents
                                <br>feedback</p>
                        </div>
                        <div class="innerItem">
                            <p>Courses and classes
                                <br>evaluation</p>
                        </div>
                        <div class="innerItem">
                            <p>Conducting academic
                                <br>research</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Business Section End -->

    <!-- customerExprerience Section Start -->
    <div class="section customerExperience customerexperience" id="customerexperience">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="work_title wow fadeInUp animated animated animated animated" data-wow-duration="600ms">
                        <h2 class="font-37">customer
                            <strong>experience</strong>
                        </h2>
                        <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                    </div>
                </div>

                <div class="col-sm-7 wow fadeInLeft animated animated animated animated" data-wow-duration="1200ms">
                    <div class="text">
                        <p>All leading companies knows that the keys to development and growth are measuring customer satisfaction
                            and listening to customer feedback. Therefore, it is keen to measure customer satisfaction continuously
                            and periodically to ensure the quality of services and products to ensure continuous growth and
                            stability in different economic conditions.</p>
                        <p>Opening the door to customer opinions to reach decision makers is one of the biggest challenges in
                            different sectors. Erjaan application sends smart surveys to your customers to evaluate the quality
                            of the service or product after each purchase. </p>
                    </div>
                </div>

                <div class="col-sm-5 wow fadeInRight animated animated animated animated" data-wow-duration="1200ms">
                    <div class="img">
                        <img src="{{asset('/erjaanhtml/img/customer-experience.jpg')}}" alt="" class="customer_img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- customerExprerience Section End -->

    <!-- GrowBusiness Section Start -->
    <div class="section growBusiness whyus" id="whyus">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mg-30 ">
                    <div class="work_title">
                        <h2 class="font-37">Why using Erjaan Surveys
                            <br/>
                            <strong>to grow business</strong>
                        </h2>
                        <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                    </div>

                </div>
                <div class="innerWrapper">

                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle">
                            <img src="{{asset('/erjaanhtml/img/why-us-1.png')}}" alt="">
                            <h5>Predict customer behavior
                            </h5>
                        </div>
                        <p>Customer feedback has a strong correlation with future spending behavior. Leverage this knowledge
                            to ensure your business is positioned correctly within your market.</p>
                    </div>
                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle">
                            <img src="{{asset('/erjaanhtml/img/why-us-2.png')}}" alt="">
                            <h5>Voice of the
                                <br>Customer</h5>
                        </div>
                        <p>Listen to your customers at every step of their journey to learn what they need, want, and expect
                            – and why.</p>
                    </div>
                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle">
                            <img src="{{asset('/erjaanhtml/img/why-us-3.png')}}" alt="">
                            <h5>Motivate your
                                <br>employees</h5>
                        </div>
                        <p>Studies has proven that employees make more effort to win a customer when there is a service evaluation</p>
                    </div>

                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle mg-43">
                            <img src="{{asset('/erjaanhtml/img/why-us-4.png')}}" alt="">
                            <h5>Reports at your
                                <br>fingertips</h5>
                        </div>
                        <p>With one click, get a snapshot of survey results, or track trends to identify drivers of loyalty
                            and dissatisfaction.</p>
                    </div>
                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle mg-43">
                            <img src="{{asset('/erjaanhtml/img/why-us-5.png')}}" alt="">
                            <h5>Always be
                                <br>branding</h5>
                        </div>
                        <p>Customize colors and fonts, incorporate your company logo. Every survey is an opportunity to build
                            the bond between your customer and your brand</p>
                    </div>
                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle mg-43">
                            <img src="{{asset('/erjaanhtml/img/why-us-6.png')}}" alt="">
                            <h5>SMS distribution &
                                <br>mobile friendly</h5>
                        </div>
                        <p>Send survey invitations by SMS for instant feedback. Create surveys that are responsive and adapt
                            to any device, with no HTML or programming knowledge required</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- GrowBusiness Section End -->

    <!-- CreateCollect Section Start -->
    <div class="section createCollect">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="work_title">
                        <h2 class="font-37">Create, collect and analyze data
                            <br/>
                            <strong>to drive business forward</strong>
                        </h2>
                        <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                    </div>

                    <div class="text-center">
                        <p>Conduct powerful surveys to gather the information you need to make the right business decisions.
                            <br>Packed full of features and built for teams, Erjaan provides the complete survey solution for
                            <br> companies of all sizes.
                        </p>
                    </div>
                </div>

                <div class="col-sm-12 wow fadeInUp animated animated" data-wow-duration="600ms">
                    <div class="innerWrapper">
                        <div class="item block-3">
                            <img src="{{asset('/erjaanhtml/img/create-1.png')}}" alt="">
                            <h6>Services</h6>
                        </div>
                        <div class="item block-3">
                            <img src="{{asset('/erjaanhtml/img/create-2.png')}}" alt="">
                            <h6>Product Quality</h6>
                        </div>
                        <div class="item block-3">
                            <img src="{{asset('/erjaanhtml/img/create-3.png')}}" alt="">
                            <h6>Staff Friendliness</h6>
                        </div>
                        <div class="item block-3">
                            <img src="{{asset('/erjaanhtml/img/create-4.png')}}" alt="">
                            <h6>Customer Satisfaction</h6>
                        </div>
                        <div class="item block-3">
                            <img src="{{asset('/erjaanhtml/img/create-5.png')}}" alt="">
                            <h6>Service Quality</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CreateCollect Section End -->

    <!-- employeeEngagement Section Start -->
    <div class="section employeeEngagement employeeengagement" id="employeeengagement">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="work_title">
                        <h2 class="font-37">Employee
                            <strong>Engagement</strong>
                        </h2>
                        <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                    </div>
                </div>
                <div class="col-sm-5 wow fadeInLeft animated animated animated animated" data-wow-duration="1200ms">
                    <div class="img">
                        <img src="{{asset('/erjaanhtml/img/employee.jpg')}}" alt="" class="customer_img">
                    </div>
                </div>
                <div class="col-sm-7 wow fadeInRight animated animated animated animated" data-wow-duration="1200ms">
                    <div class="text">
                        <p>Human resource managers and business owners knows that employees who are not fully engaged with their
                            jobs are significantly less productive and it is the other way around with employees who are
                            fully engaged with their jobs. There are several factors that play a key roles in productivity
                            and employee engagement</p>
                        <p>Quality of the work environment - Adopting and understanding of the company goals - Employee's understanding
                            of his duties and and its contribution to the company goals.</p>
                    </div>
                </div>
            </div>

            <div class="row mg_10">
                <div class="col-sm-12">
                    <p>Employee engagement is the process of measuring the employee's productivity and engagement factors to
                        his job, and this process aims to increase the performance of employees by measuring the engagement
                        indicators and productivity factors of the employees in all leading companies to know the challenges
                        and aspects of development that concern the employee and work to improve the work environment</p>
                </div>
            </div>
        </div>
    </div>
    <!-- employeeEngagement Section End -->

    <!-- productive Section Start -->
    <div class="section productive factors" id="factors">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="work_title">
                        <h2 class="font-37">Productive
                            <strong>factors</strong>
                        </h2>
                        <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="innerWrapper">
                        <div class="item">
                            <div class="img">
                                <img src="{{asset('/erjaanhtml/img/productive-1.png')}}" alt="">
                            </div>
                            <h6>Personal
                                <br> engagement</h6>
                        </div>
                        <div class="item">
                            <div class="img">
                                <img src="{{asset('/erjaanhtml/img/productive-2.png')}}" alt="">
                            </div>
                            <h6>Purpose
                                <br> alignment</h6>
                        </div>
                        <div class="item">
                            <div class="img">
                                <img src="{{asset('/erjaanhtml/img/productive-3.png')}}" alt="">
                            </div>
                            <h6>Job
                                <br> satisfaction</h6>
                        </div>
                        <div class="item">
                            <div class="img">
                                <img src="{{asset('/erjaanhtml/img/productive-4.png')}}" alt="">
                            </div>
                            <h6>Team
                                <br> dynamics</h6>
                        </div>
                        <div class="item">
                            <div class="img">
                                <img src="{{asset('/erjaanhtml/img/productive-5.png')}}" alt="">
                            </div>
                            <h6>Visible
                                <br> future</h6>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- productive Section End -->
    <!-- Second Setion Start-->
    <div class="section productive2">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 wow fadeInLeft animated animated animated animated" data-wow-duration="600ms">
                    <div class="innerWrapper">
                        <div class="text">
                            <ul>
                                <li>
                                    <span>1</span>Erjaan Employee Experience Solution is smart survey solution designed help businessowner
                                    and HR manager to have an accurate reading over productivity factors with a systematic
                                    approach. </li>

                                <li>
                                    <span>2</span>Design and configure the survey to suit your business needs or use our best practice
                                    templates </li>

                                <li>
                                    <span>3</span>Send survey manual and automatically with amazing scheduling features and reminder
                                </li>

                                <li>
                                    <span>4</span>Smart KPI calculating score from Surveys answers </li>

                                <li>
                                    <span>5</span>Drill deep into the report and charts with your organization hierarchy </li>

                                <li>
                                    <span>6</span>Have a yearly KPIs and reports comparison to track progress</li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-sm-5 wow fadeInRight animated animated animated animated" data-wow-duration="600ms">
                    <div class="img">
                        <img src="{{asset('/erjaanhtml/img/productive.jpg')}}" alt="" class="customer_img">
                    </div>
                </div>
            </div>

            <div class="row sendSurvery">

                <div class="col-lg-10 col-md-8 col-sm-8">
                    <div class="text2">
                        <h5>Send
                            <strong>Survery</strong>
                        </h5>
                        <p>Send your survey by SMS and instantly reach your target audience. Achieve increased response rates
                            and improved customer engagement with Erjaan.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 text-right">
                    <div class="btnDiv">
                        <a href="javascript:void(0);" class="sendbtn">Send Now</a>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Second Setion End-->

    <!-- whatMakes Section Start -->
    <div class="section whatMakes">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="work_title">
                        <h2 class="font-37">What makes
                            <br>
                            <strong>Erjaan right for you?</strong>
                        </h2>
                        <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                    </div>

                    <div class="text-center">
                        <p>We will help you collect the information you need quickly and easily. Trust us to safeguard your
                            <br> data and provide the support you need, when you need it.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row mg_28">
                <div class="col-sm-6">
                    <div class="main-content_panel">
                        <div class="head">
                            <span>1</span>
                            <h5>Key Performance Indicators KPIs</h5>
                        </div>
                        <p>Erjaan solutions allows you to make performance measurement indicators and link them to questionnaires
                            for accurate and instantaneous readings</p>
                    </div>
                    <div class="main-content_panel">
                        <div class="head">
                            <span>2</span>
                            <h5>Nothing to install</h5>
                        </div>
                        <p>No complicated installations or downloads, just sign up and create surveys through your browser.</p>
                    </div>
                    <div class="main-content_panel">
                        <div class="head">
                            <span>3</span>
                            <h5>Easy to use</h5>
                        </div>
                        <p>Intuitive user-led design, with easy to follow step-by-step guides.</p>

                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="main-content_panel">
                        <div class="head">
                            <span>4</span>
                            <h5>Secure</h5>
                        </div>
                        <p>We proud ourselves of the security standards we follow and apply during processing your data.</p>

                    </div>
                    <div class="main-content_panel">
                        <div class="head">
                            <span>5</span>
                            <h5>Support</h5>
                        </div>
                        <p>Help when you need it, through email, live chat and telephone.</p>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- whatMakes Section End -->

    <!-- aboutUs Section Start -->
    <div class="section aboutUs footer_about aboutus" id="aboutus">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="work_title">
                        <h2 class="font-37">know
                            <strong>about us</strong>
                        </h2>
                        <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                    </div>
                </div>

                <div class="col-sm-7 wow fadeInLeft animated animated animated animated" data-wow-duration="600ms">
                    <div class="text">
                        <p>After realizing the huge need for a smart survey solution that is adoptable to different industries
                            to serve collect the right data from the right people through out the right channels in this
                            digital age Erjaan was born.</p>
                        <p>Erjaan is a Saudi company specializing in cloud smart surveys solutions aiming to help organizations
                            in business , healthcare and education sectors to make smarter decisions to drive growth by collecting
                            and analyzing the right data from the right sources And because we know that’s running a successful
                            solution using survey depends on many factors including building advanced survey with the right
                            measuring tools, distributions and triggering tools combined with industrial know-hows , we at
                            Erjaan work day and night to insure that each of our partner work with the right mix of tools
                            and features to deliver a tangible value.</p>
                    </div>
                </div>
                <div class="col-sm-5 wow fadeInRight animated animated animated animated" data-wow-duration="600ms">
                    <div class="img">
                        <img src="{{asset('/erjaanhtml/img/about-us.jpg')}}" alt="" class="customer_img">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <p>we try to position ourselves as a destination for organization who seeks growth thru reading and measuring
                        their performance and identify lack of growth areas by asking the right question at the right time
                        to the right people .</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contact Us Section Start -->
    <div class="section aboutUs footer_about contact" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="work_title">
                        <h2 class="font-37">Contact
                            <strong>Us</strong>
                        </h2>
                        <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                    </div>
                </div>

                <div class="col-sm-1"> </div>
                <div class="col-sm-10 contacrfrom wow fadeInDown animated animated animated animated" data-wow-duration="600ms">
                   <form>

<div class="col-sm-4">
<div class="form-group">
             <input name="your-name" value="" size="40" class="form-control"  placeholder="Enter Your Name" type="text">
          </div>
</div>

<div class="col-sm-4">
<div class="form-group">
        <input name="your-email" value="" size="40" class="form-control" placeholder="Enter Your Email" type="email">
         </div>
</div>

<div class="col-sm-4">
<div class="form-group">
         <input name="your-subject" value="" size="40" class="form-control"  placeholder="Enter Your Mobile Number" type="text">
         </div>
</div>

<div class="col-sm-12">
<div class="form-group">
        <textarea name="your-message" cols="40" rows="6" class="form-control"  placeholder="Enter Your Message"></textarea>
      </div>
</div>
<div class="col-sm-12">
<div class="form-group">

       <input value="Send" class="btn btn-primary btn-lg submitbtn" type="button">
      </div>
      </div>

</form>
                </div>
            </div>

            
        </div>
    </div>

@stop