@extends('layout.front_arebic.content')

{{-- Page content --}}
@section('inners_body')
<!-- ABOUT 
            =================-->
             <!-- Top Banner Sec -->
     <!-- Top Banner Sec -->
    <section id="topBanner" class="topBanner">
        <div class="container">
            <div class="row">
                <div class="topBnrTxt">
                    <h1 class="wow bounceIn" data-wow-duration="600ms">حلول الأستبيانات الرقمية </h1>
                    <p class="wow bounceIn" data-wow-duration="900ms" style="font-size: 24px;">الأرجان هي شركة سعودية متخصصة في حلول الاستبيانات الذكية والتي تهدف إلى مساعدة المؤسسات في قطاعات الأعمال والرعاية الصحية والتعليم في اتخاذ قرارات أكثر ذكاء لرفع مستوي النمو عن طريق جمع وتحليل البيانات الصحيحة من المصادر الصحيحة</p>
                    <p class="header_sub">نحن فخورون بالحلول التي نقدمها</p>
                    <ul class="buttons">
                       <li>
                            <a href="#customerexperience" class="downloadButtons scrollto">
                                <img src="{{asset('/erjaanhtml/img/arcustomer.png')}}" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#employeeengagement" class="downloadButtons scrollto">
                                <img src="{{asset('/erjaanhtml/img/aremployer.png')}}" alt="">
                            </a>
                        </li>
                    </ul>

                </div>
                <!--  <div class="scrollDown">
                    <a href="#howItWork">
                        <img src="{{asset('/erjaanhtmlarbaic/imgscrollmouse.png')}} alt="">
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
                        <h2 class="font-37">كيفية عمل تطبيق الأرجان</h2>
                        <img src="{{asset('/erjaanhtmlarbaic/img/title.png')}}" alt="">
                    </div>
                    <p class="text-center font-20 work_para">يعمل تطبيق الأرجان للستبيانات الذكية على مساعدة المنشئات في عملية اتخاذ القرارات الصحيحة عن طريق جمع المعومات و تحليلها من مصادرها الصحيحة عن طريق نظام استبيانات ذكي مصمم ليساعد اصحاب القرار للحصول على المعلومات و ربطها بمؤشرات الأداء  سواء كنت تبحث عن قياس رضا العميل و أعطاء صوت للعميل او كنت تبحث عن رفع كفائة الموظفين  عن طريق قياس مؤشرات الأرتباط و الأنتاجية

                    </p>
                </div>
            </div>

            <div class="row featuire_panel text-center">
                <div class="col-sm-3 col-xs-6 no_padding">
                    <div class="borderBot">
                        <div class="border">
                            <img src="{{asset('/erjaanhtmlarbaic/img/howit-1.png')}}" alt="">
                        </div>
                    </div>
                    <div class="triangle"></div>
                    <div class="text">
                        <h6>انشاء</h6>
                        <p>قم بإنشاء الاستبيان الذي تحتاجه بما يتناسب مع نشاطك او استخدم القوالب الخاصة بنا والتي تم تجهيزها بما يتوافق مع افضل الممارسات في قطاعات مختلفة 

</p>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 no_padding">
                    <div class="borderBot">
                        <div class="border">
                            <img src="{{asset('/erjaanhtmlarbaic/img/howit-2.png')}}" alt="">
                        </div>
                    </div>
                    <div class="triangle"></div>
                    <div class="text">
                        <h6>ارسال </h6>
                        <p>استخدم أدوات الأرجان المضمنة لأرسال  الاستبيانات الخاصة بك تلقائيًا  او يدويا من خلال الرسائل النصية القصيرة أو البريد الإلكتروني
</p>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 no_padding">
                    <div class="borderBot">
                        <div class="border">
                            <img src="{{asset('/erjaanhtmlarbaic/img/howit-3.png')}}" alt="">
                        </div>
                    </div>
                    <div class="triangle"></div>
                    <div class="text">
                        <h6>جمع المعلومات </h6>
                        <p>اسمح للمشاركين من عملاء او موظفين و غيرهم من تعبئة الأستبيانات من هواتفهم المحمولة في اي وقت و اي مكان
</p>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 no_padding">
                    <div class="borderBot">
                        <div class="border">
                            <img src="{{asset('/erjaanhtmlarbaic/img/howit-4.png')}}" alt="">
                        </div>
                    </div>
                    <div class="triangle"></div>
                    <div class="text">
                        <h6>تحليل المعلومات 
</h6>
                        <p>التحليل الفوري وإعداد التقارير للاستبيانات التي تشمل تمثيل مرئي للبيانات مع امكانية ربط الأستبيانات بمؤشرات قياس الأداء
</p>
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
                            <h2>تم تطوير تطبيق الأرجان مع وضع الجميع في الاعتبار
</h2>
                            <img src="{{asset('/erjaanhtmlarbaic/img/title.png')}}" alt="">
                        </div>
                        <p class="leftpara">يتم استخدام الأرجان من قبل الشركات والمؤسسات التعليمية والطلاب ومزود الرعاية الصحية لبناء وإرسال وجمع وتحليل البيانات كل يوم.</p>
                    </div>
                </div>
                <div class="item block-6 rightSide text-center wow fadeInRight animated animated" data-wow-duration="600ms">
                    <div class="text">
                        <div class="title">
                            <h2>الحلول والصناعات</h2>
                            <img src="{{asset('/erjaanhtmlarbaic/img/title-white.png')}}" alt="">
                        </div>
                        <p class="rightpara">يمكنك الاستفادة من حلول الأستبيانات و القوالب المصنوعة لك خصيصا والذي سيجعلك تتحول من صانع استبيانات لباحث محترف في خلال فترة وجيزة. سواء كنت من محترفي الرعاية الصحية أو كنت ترغب في تقييم رضا موظفيك، تحقق من الحلول الموضحة أدناه لمعرفة كيف يمكن لشركة الأرجان من تطوير اعمالك و مساعدتك في اتخاذ القرارات.
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
                                <img src="{{asset('/erjaanhtmlarbaic/img/busn-1.png')}}" alt="">
                            </div>
                            <h6>القطاع التجاري</h6>
                        </div>
                        <div class="innerItem">
                            <p>رضا العملاء، تجربة العميل</p>
                        </div>
                        <div class="innerItem">
                            <p>اجراء الأبحاث في السوق</p>
                        </div>
                        <div class="innerItem">
                            <p>تطوير وتفاعل الموظف بعمله و قياس ارتباط الموظفين</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="content">
                        <div class="itemImg">
                            <div class="img">
                                <img src="{{asset('/erjaanhtmlarbaic/img/busn-2.png')}}" alt="">
                            </div>
                            <h6>القطاع الصحي</h6>
                        </div>
                        <div class="innerItem">
                            <p>تجربة المريض ونسبة رضاه</p>
                        </div>
                        <div class="innerItem">
                            <p>تطوير و تحفيز الطاقم الطبي</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="content">
                        <div class="itemImg">
                            <div class="img">
                                <img src="{{asset('/erjaanhtmlarbaic/img/newicon.PNG')}}" alt="">
                            </div>
                            <h6>قطاع التعليم</h6>
                        </div>
                        <div class="innerItem">
                            <p>آراء اولياء امور الطلاب</p>
                        </div>
                        <div class="innerItem">
                            <p>تقييم الدورات والدروس</p>
                        </div>
                        <div class="innerItem">
                            <p>إجراء البحوث الأكاديمية</p>
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
                        <h2 class="font-37">تجربة العميل </h2>
                        <img src="{{asset('/erjaanhtmlarbaic/img/title.png')}}" alt="">
                    </div>
                </div>

                <div class="col-sm-7 wow fadeInLeft animated animated animated animated" data-wow-duration="1200ms">
                    <div class="text">
                        <p>تعلم جميع المنشئآت التجارية الرائدة ان مفاتيح التطور و النمو تكمن في قياس رضا العملاء و الأستماع لأراء العملاء. ولذالك تحرص على قياس رضا العملاء بشكل مستمر و دوري للتأكد من جودة الخدمات و المنتجات لضمان نمو مستمر و استقرار في مختلف الضروف الأقتصادية.  فتح المجال امام اراء العملاء لتصل الى صناع القرار تعتبر من اكبر التحديات في مختلف القطاعات . يعمل تطبيق الأرجان على ارسال استبيانات ذكية لعملائك لتقييم جودة الخدمة او المنتج  بعد كل عملية شراء .كما تتيح لك الأستبينات سماع اراء عملائك للحصول على قرائات دقيقة عن جودة المنتجات و الخدمات و تعامل موظفين الخطوط الأمامية . تساعدك استبيانات الأرجان على اتخاذ القرارات الصحيحة.حصولك على هاذة البيانات يفتح لك افاق جديدة من تطوير الخدمة او المنتج مما يضمن نمو مستمر لأعمالك.
</p>
                    </div>
                </div>

                <div class="col-sm-5 wow fadeInRight animated animated animated animated" data-wow-duration="1200ms">
                    <div class="img">
                        <img src="{{asset('/erjaanhtmlarbaic/img/customer-experience.jpg')}}" alt="" class="customer_img">
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
                        <h2 class="font-37">كيف استفيد من تطبيق الأرجان لقياس تجربة العميل لتنمية الأعمال التجارية</h2>
                        <img src="{{asset('/erjaanhtmlarbaic/img/title.png')}}" alt="">
                    </div>

                </div>
                <div class="innerWrapper">

                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle">
                            <img src="{{asset('/erjaanhtmlarbaic/img/why-us-1.png')}}" alt="">
                            <h5>توقع سلوك العملاء</h5>
                        </div>
                        <p>ردود فعل العملاء لديها علاقة قوية مع سلوك الإنفاق في المستقبل. استفد من هذه المعرفة لضمان وضع شركتك بشكل صحيح في السوق الخاص بك.</p>
                    </div>
                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle">
                            <img src="{{asset('/erjaanhtmlarbaic/img/why-us-2.png')}}" alt="">
                            <h5>استمع الى العميل</h5>
                        </div>
                        <p>استمع إلى عملائك في كل خطوة في رحلتهم لمعرفة ما يحتاجون إليه ويريدونه ويتوقعونه  - ولماذا.</p>
                    </div>
                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle">
                            <img src="{{asset('/erjaanhtmlarbaic/img/why-us-3.png')}}" alt="">
                            <h5>تحفيز موظفيك</h5>
                        </div>
                        <p>أثبتت الدراسات أن الموظفين يبذلون المزيد من الجهد للفوز بزبون عندما يكون هناك تقييم لخدمتهم</p>
                    </div>

                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle mg-43">
                            <img src="{{asset('/erjaanhtmlarbaic/img/why-us-4.png')}}" alt="">
                            <h5>تقارير في متناول يدك</h5>
                        </div>
                        <p>بنقرة واحدة، احصل على لمحة من نتائج الاستبيان، أو تتبع الميول لتحديد محركات الولاء وعدم الرضا.</p>
                    </div>
                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle mg-43">
                            <img src="{{asset('/erjaanhtmlarbaic/img/why-us-5.png')}}" alt="">
                            <h5>حافظ على علامتك التجارية</h5>
                        </div>
                        <p>تخصيص الألوان والخطوط، دمج شعار شركتك. كل استبيان هو بمثابة فرصة لبناء الرابط بين عميلك وعلامتك التجارية</p>
                    </div>
                    <div class="col-md-4 col-sm-6 gridsystem">
                        <div class="iconAndTitle mg-43">
                            <img src="{{asset('/erjaanhtmlarbaic/img/why-us-6.png')}}" alt="">
                            <h5>توزيع الرسائل القصيرة والمناسبة للهاتف المحمول</h5>
                        </div>
                        <p>إرسال دعوات الاستبيان عن طريق الرسائل القصيرة للحصول على آراء فورية. يمكنك إنشاء استبيانات تستجيب وتتوافق مع أي جهاز</p>
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
                        <h2 class="font-37">إنشاء وجمع وتحليل البيانات لتطوير مستمر</h2>
                        <img src="{{asset('/erjaanhtmlarbaic/img/title.png')}}" alt="">
                    </div>

                    <div class="text-center">
                        <p>إجراء استبيانات ذكية لجمع المعلومات التي تحتاجها لأتخاذ القرارات الصحيحة. تقدم شركة الأرجان حلول الاستبيانات للشركات من جميع الأحجام و مختلف القطاعات. </p>
                    </div>
                </div>

                <div class="col-sm-12 wow fadeInUp animated animated" data-wow-duration="600ms">
                    <div class="innerWrapper">
                        <div class="item block-3">
                            <img src="{{asset('/erjaanhtmlarbaic/img/create-1.png')}}" alt="">
                            <h6>خدمات</h6>
                        </div>
                        <div class="item block-3">
                            <img src="{{asset('/erjaanhtmlarbaic/img/create-2.png')}}" alt="">
                            <h6>جودة المنتج</h6>
                        </div>
                        <div class="item block-3">
                            <img src="{{asset('/erjaanhtmlarbaic/img/create-3.png')}}" alt="">
                            <h6>صداقة الموظفين</h6>
                        </div>
                        <div class="item block-3">
                            <img src="{{asset('/erjaanhtmlarbaic/img/create-4.png')}}" alt="">
                            <h6>رضا العملاء</h6>
                        </div>
                        <div class="item block-3">
                            <img src="{{asset('/erjaanhtmlarbaic/img/create-5.png')}}" alt="">
                            <h6>جودة الخدمة</h6>
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
                        <h2 class="font-37">قياس تجربة الموظفين </h2>
                        <img src="{{asset('/erjaanhtmlarbaic/img/title.png')}}" alt="">
                    </div>
                </div>
                <div class="col-sm-5 wow fadeInLeft animated animated animated animated" data-wow-duration="1200ms">
                    <div class="img">
                        <img src="{{asset('/erjaanhtmlarbaic/img/employee.jpg')}}" alt="" class="customer_img">
                    </div>
                </div>
                <div class="col-sm-7 wow fadeInRight animated animated animated animated" data-wow-duration="1200ms">
                    <div class="text">
                        <p>يعلم مدراء الموارد البشرية و اصحاب المنشئآت التجارية ان الموظفين الغير مرتبطين بشكل كامل في وظائفهم تقل انتاجيتهم بشكل كبير و العكس مع الموظفين المرتبطين بالكامل مع وظائفهم حيث توجد عدة عوامل تلعب دورا اساسياَ في انتاجية و ارتباط الموظفين منها جودة بيئة العمل - تبني اهداف الشركة - فهم الموظف لمهامة الوظيفية و ارتباطها بأهداف الشركة.</p>
                    </div>
                </div>
            </div>

            <div class="row mg_10">
                <div class="col-sm-12">
                    <p>تحليل تجربة الموظفين هي عملية قياس مدى ارتباط و انتاجية الموظف في وظيفتة و بالشركة و تهدف لرفع اداء الموظفين عن طريق قياس مؤشرات الأرتباط وعوامل الأنتاجية لدي الموظقين المتبعة في جميع الشركات الرائدة لمعرفة الجوانب القصور و جوانب التطوير التي تهم الموظف و العمل على تحسين بيئة العمل
</p>
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
                        <h2 class="font-37">عوامل الأنتاجية لدى الموظفين</h2>
                        <img src="{{asset('/erjaanhtmlarbaic/img/title.png')}}" alt="">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="innerWrapper">
                        <div class="item">
                            <div class="img">
                                <img src="{{asset('/erjaanhtmlarbaic/img/productive-1.png')}}" alt="">
                            </div>
                            <h6>رضى الموظفين</h6>
                        </div>
                        <div class="item">
                            <div class="img">
                                <img src="{{asset('/erjaanhtmlarbaic/img/productive-2.png')}}" alt="">
                            </div>
                            <h6>فهم اهداف الوظيفة و الشركة</h6>
                        </div>
                        <div class="item">
                            <div class="img">
                                <img src="{{asset('/erjaanhtmlarbaic/img/productive-3.png')}}" alt="">
                            </div>
                            <h6>رضى الموظفين عن مدرائهم</h6>
                        </div>
                        <div class="item">
                            <div class="img">
                                <img src="{{asset('/erjaanhtmlarbaic/img/productive-4.png')}}" alt="">
                            </div>
                            <h6>تعاون فريق العمل</h6>
                        </div>
                        <div class="item">
                            <div class="img">
                                <img src="{{asset('/erjaanhtmlarbaic/img/productive-5.png')}}" alt="">
                            </div>
                            <h6>التطور المهني</h6>
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
                                    <span>1</span>تطبيق الأرجان لقياس تجربة الموظفين عمل على نظام استبيانات ذكي يتيح لأصحاب ألأنشطة التجارية و مدراء الموارد البشرية بالحصوص على قرائات دقيقة على كل عامل من عوامل الأنتاجية </li>

                                <li>
                                    <span>2</span>يتيح لك النطبيق التعديل على الأستبيانات و التقارير بما يتناسب مع نشاطك التجاري </li>

                                <li>
                                    <span>3</span>يتيح لك التطبيق التحكم في عمليات الأرسال و التذكير و جدولتها</li>

                                <li>
                                    <span>4</span>انشئ وحدات قياس الأداء بما يتناسب مع نشاطك التجاري</li>

                                <li>
                                    <span>5</span>يتيح لك التطبيق القوص في التقارير و عرضها على شكل الهيكل التنظيمي لنشاطك التجاري</li>

                                <li>
                                    <span>6</span>احفظ التقارير سنوياً لمعرفة مستوى التطور </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-sm-5 wow fadeInRight animated animated animated animated" data-wow-duration="600ms">
                    <div class="img">
                        <img src="{{asset('/erjaanhtmlarbaic/img/productive.jpg')}}" alt="" class="customer_img">
                    </div>
                </div>
            </div>

            <div class="row sendSurvery">

                <div class="col-lg-10 col-md-8 col-sm-8">
                    <div class="text2">
                        <h5>يمكنك إرسال الاستبيان الخاص بك عن طريق الرسائل القصيرة والوصول الي جمهورك المستهدف علي الفور</h5>
                        <p>يمكنك تطبيق الأرجان من إرسال الاستبيان الخاص بك عن طريق رسالة قصيرة والوصول الي جمهورك المستهدف علي الفور وتحقيق زيادة معدلات الاستجابة وتحسين تفاعل العملاء</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 text-right">
                    <div class="btnDiv">
                        <a href="javascript:void(0);" class="sendbtn">ارسل الان</a>
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
                        <h2 class="font-37">ما الذي يجعل شركة الأرجان مناسبة لك؟</h2>
                        <img src="{{asset('/erjaanhtmlarbaic/img/title.png')}}" alt="">
                    </div>

                    <div class="text-center">
                        <p>سنساعدك في جمع المعلومات التي تحتاجها بسرعة وسهولة. ثق بنا في حماية بياناتك وتوفير الدعم الذي تحتاجه، عندما تحتاج إليه.</p>
                    </div>
                </div>
            </div>

            <div class="row mg_28">
                <div class="col-sm-6">
                    <div class="main-content_panel">
                        <div class="head">
                            <span>1</span>
                            <h5>لا حاجة لتثبيت التطبيق</h5>
                        </div>
                        <p>لا توجد عمليات تثبيت أو تنزيل معقدة، ما عليك سوى الاشتراك وإنشاء الاستبيانات عبر متصفحك.</p>
                    </div>
                    <div class="main-content_panel">
                        <div class="head">
                            <span>2</span>
                            <h5>سهولة الاستخدام</h5>
                        </div>
                        <p>تصميم سهل الاستخدام من قبل المستخدم، مع سهولة اتباع الإرشادات خطوة بخطوة.</p>
                    </div>
                    <div class="main-content_panel">
                        <div class="head">
                            <span>3</span>
                            <h5>الدعم الفني</h5>
                        </div>
                        <p>مساعدتك في أي وقت، من خلال البريد الإلكتروني، الدردشة المباشرة والهاتف.</p>

                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="main-content_panel">
                        <div class="head">
                            <span>4</span>
                            <h5>مؤشرات قياس الأداء</h5>
                        </div>
                        <p>يتيح لك تطبيق الأرجان عمل مؤشرات قياس الأداء و ربطها بالأستبيانات للحصول على قرائات دقيقة و لحظية</p>

                    </div>
                    <div class="main-content_panel">
                        <div class="head">
                            <span>5</span>
                            <h5>أمن المعلومات</h5>
                        </div>
                        <p>نفخر في شركة الأرجان بتباع اعلى معاير الأمن و الحماية لنبقي البيانات امنة</p>

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
                        <h2 class="font-37">من نحن</h2>
                        <img src="{{asset('/erjaanhtmlarbaic/img/title.png')}}" alt="">
                    </div>
                </div>

                <div class="col-sm-7 wow fadeInLeft animated animated animated animated" data-wow-duration="600ms">
                    <div class="text">
                        <p>بعد إدراك الحاجة الكبيرة لحلول الاستبيانات الرقمية التي يمكن تبنيها لمختلف القطاعات لكي يتم جمع البيانات الصحيحة من الأشخاص المناسبين وبالطريقة الصحيحة لتخاذ القرارات الصحيحة تم انشاء شركة الأرجان</p>
                        
                        <p>الأرجان هي شركة سعودية متخصصة في حلول الاستبيانات الذكية والتي تهدف إلى مساعدة المؤسسات في قطاعات الأعمال والرعاية الصحية والتعليم في اتخاذ قرارات أكثر ذكاء لرفع مستوي النمو عن طريق جمع وتحليل البيانات الصحيحة من المصادر الصحيحة</p>
                        
						<p>ولأننا نعلم أن التوصل الي حل ناجح باستخدام الاستبيان يعتمد على العديد من العوامل منها بناء استبيان ذكي و استخدام أدوات القياس الصحيحة و طرق الأرسال و جمع المعلومات، فنحن في شركة الأرجان نعمل ليلاً ونهارًا للتأكد من أن كل شريك لدينا يعمل بالمزيج الصحيح من الأدوات والمميزات للحصول على قيمة ملموسة</p>
                    </div>
                </div>
                <div class="col-sm-5 wow fadeInRight animated animated animated animated" data-wow-duration="600ms">
                    <div class="img"> 
                        <img src="{{asset('/erjaanhtmlarbaic/img/about-us.jpg')}}" alt="" class="customer_img">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <p>نطمح أن نضع أنفسنا كوجهة للمنشئات التي تسعى للنمو من خلال قراءة وقياس أدائها وتحديد مناطق النمو و الضعف من خلال طرح السؤال  الصحيح في الوقت المناسب وللأشخاص المناسبين. </p>
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
                        <h2 class="font-37">اتصل  
                            <strong>بنا</strong>
                        </h2>
                        <img src="{{asset('/erjaanhtml/img/title.png')}}" alt="">
                    </div>
                </div>

                <div class="col-sm-1"> </div>
                <div class="col-sm-10 contacrfrom wow fadeInDown animated animated animated animated" data-wow-duration="600ms">
                   <form>

<div class="col-sm-4">
<div class="form-group">
             <span class="your-name"><input name="your-name" value="" size="40" class="form-control"  placeholder="أدخل أسمك" type="text"></span>
          </div>
</div>

<div class="col-sm-4">
<div class="form-group">
         <span class="your-email"><input name="your-email" value="" size="40" class="form-control" placeholder="أدخل بريدك الالكتروني" type="email"></span>
         </div>
</div>

<div class="col-sm-4">
<div class="form-group">
         <span class="your-subject"><input name="your-subject" value="" size="40" class="form-control"  placeholder="أدخل رقم هاتفك المحمول" type="text"></span>
         </div>
</div>

<div class="col-sm-12">
<div class="form-group">
        <span class="	your-message"><textarea name="your-message" cols="40" rows="6" class="form-control"  placeholder="أدخل رسالتك"></textarea></span>
      </div>
</div>
<div class="col-sm-12">
<div class="form-group">

       <input value="إرسال" class="btn btn-primary btn-lg submitbtn" type="button">
      </div>
      </div>

</form>
                </div>
            </div>

            
        </div>
    </div>

@stop