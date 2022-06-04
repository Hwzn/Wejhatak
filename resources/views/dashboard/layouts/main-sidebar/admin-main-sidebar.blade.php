<div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ url('/admin/dashboard') }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Wejhatak_App')}} </li>

              <!-- attributes-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#attrbute-menu">
                            <div class="pull-left"><i class="fas fa-building"></i><span
                                    class="right-nav-text">{{trans('attribute_trans.attrubites')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="attrbute-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('showattributes_types')}}">{{trans('attributetype_trans.attrubite_type')}}</a></li>
                            <li><a href="{{route('showattributes')}}">{{trans('attribute_trans.attrubiteslist_services')}}</a></li>
                            <li>
                              <a href="{{route('ads_attribute')}}">
                                {{trans('ads_trans.AdsAttributes_List')}}
                              </a>
                            </li>
                          
                        </ul>
                       
                    </li>
                    <!-- services-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                            <div class="pull-left"><i class="fas fa-building"></i><span
                                    class="right-nav-text">{{trans('main_trans.Services')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('showservices')}}">{{trans('main_trans.Services_list')}}</a></li>
                            <li><a href="{{route('showservice_attribute')}}">{{trans('serviceattribute_trans.service_attribute')}}</a></li>

                        </ul>
                    </li>
                 
                  <!-- Contactus-->
                  <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#contactus-menu">
                            <div class="pull-left"><i class="fas fa-building"></i><span
                                    class="right-nav-text">{{trans('main_trans.Contactus')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="contactus-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('contactus')}}">{{trans('main_trans.Contactus_Messages')}}</a></li>
                        </ul>
                    </li>
                 
                     <!-- aboutus-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#aboutus-menu">
                            <div class="pull-left"><i class="fas fa-building"></i><span
                                    class="right-nav-text">{{trans('main_trans.Aboutus')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="aboutus-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('aboutus')}}">{{trans('Aboutus_trans.aboutus')}}</a></li>
                        </ul>
                    </li>

                    <!-- ShowCommonQuestions -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#CommonQuestions-menu">
                            <div class="pull-left"><i class="fas fa-building"></i><span
                                    class="right-nav-text">{{trans('main_trans.ShowCommonQuestions')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="CommonQuestions-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('ShowCommonQuestions')}}">{{trans('CommonQuestions_trans.CommonQuestions')}}</a></li>
                        </ul>
                    </li>

                      <!-- ShoHelps -->
                      <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#ShoHelps-menu">
                            <div class="pull-left"><i class="fas fa-building"></i><span
                                    class="right-nav-text">{{trans('main_trans.Helps')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="ShoHelps-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('Showhelps')}}">{{trans('helps_trans.Helps_Types')}}</a></li>
                            <li><a href="{{route('ShowhelpRequests')}}">{{trans('helps_trans.Requests_Help')}}</a></li>

                        </ul>
                    </li>

                     <!-- Terms and Condition -->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#ShoTerms-menu">
                            <div class="pull-left"><i class="fas fa-building"></i><span
                                    class="right-nav-text">{{trans('main_trans.TermsAndConditions')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="ShoTerms-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('terms_conditions')}}">{{trans('Terms_trans.TermsAndConditions')}}</a></li>
                        </ul>
                    </li>


                   <!-- Terms and Condition -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#UsagePolicy-menu">
                            <div class="pull-left"><i class="fas fa-building"></i><span
                                    class="right-nav-text">{{trans('main_trans.UsagePolicy')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="UsagePolicy-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('usagepolicy')}}">{{trans('main_trans.UsagePolicy')}}</a></li>
                        </ul>
                    </li>

                     <!-- Ads SlideShow -->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#AdsSlideShow-menu">
                            <div class="pull-left"><i class="fas fa-building"></i><span
                                    class="right-nav-text">{{trans('main_trans.AdsSlideShow')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="AdsSlideShow-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('Ads_SlideShow')}}">{{trans('AdsSlideShow_trans.Ads_list')}}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>