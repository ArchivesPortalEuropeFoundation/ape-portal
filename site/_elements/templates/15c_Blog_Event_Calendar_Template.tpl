<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

<section id="innerHero"[[*heroAlign:is=`left`:then=` class="left"`]]>
    <div class="container">
        [[$breadcrumbs]]
        <div class="content">
            <h1>[[*heroTitle:notempty=`[[*heroTitle]]`:default=`[[*pagetitle]]`]]</h1>
            [[*heroText]]
            <p>[[!%asi.title_events_shown_time_zone? &topic=`default` &namespace=`asi`]]: <span class="timezone"><strong>Central European Time</strong> - Amsterdam</span></p>
        </div>
        <div class="text-center">
            <strong>[[!%asi.title_show_events_in? &topic=`default` &namespace=`asi`]]:</strong>
            <div class="selectDropdown" id="filterCountries">
				<div class="title">[[!%asi.title_all_countries? &topic=`default` &namespace=`asi`]]</div>
				<div class="inner">
                	<a>[[!%asi.title_all_countries? &topic=`default` &namespace=`asi`]]</a>
				</div>
			</div>
        </div>
    </div>
</section>
	
<section class="standard">
    <div class="container">
        <div id="calendar"></div>
    </div>
</section>	
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$calendarEventPopup]]

[[$scripts]]

<script src="assets/js/moment.js"></script>
<script src="assets/js/fullcalendar.min.js"></script>

<script>
    $(document).ready(function(){
        
        var firstRun = 'Yes'
        var countryFilter = 'All countries';
        var countryList = [];
        var categoryList = [];
        //var categoryUnchecked = [];
        
        var sources = {
                [[!TaggerGetTags?
                  &groups=`4`
                  &rowTpl=`taggerEventCategoryTpl`
                  &sort=`{"rank": "ASC"}`
                  &separator=`,`
                ]]
        };        
        
        $('#calendar').fullCalendar({
            header: {
                left:   'prev,title,next',
                center: '',
                right:  'today'
            },
            buttonText: {
                today: 'Today'
            },
            eventSources: [
                [[TaggerGetTags?
                  &groups=`4`
                  &rowTpl=`taggerEventSourceTpl`
                  &sort=`{"rank": "ASC"}`
                  &separator=`,`
                ]]
                ],
            eventRender: function(event,element) {    
                // Filter by country
                if (countryFilter !== 'All countries') {
                  if (event.country !== countryFilter) {
                      countryList.push(event.country);
                      return false;
                  }
                }
                
                // Filter by category
                if (firstRun !== 'Yes') {
                    var lCategory = event.category.toLowerCase().replace(/\s/g, '');
                    if ($('#calendar input[name="' + lCategory +'"]:checked').val() !== 'yes') {
                        categoryList.push(event.category);
                        return false;
                    }
                }
                
                //Build full event title
                var country = '';
                if (event.country) {
                    country =  ' (' + event.country + ')';
                }
                var fullTitle = '<strong>' + event.title + '</strong>' + country;
                element.find('.fc-title').html(fullTitle);
                
                // Check for past events
                var todayDate = moment().add(1, 'days').format("YYYY-MM-DD");
                var startDate = event.start.format("YYYY-MM-DD");
                if (event.end == null) {
                    var endDate = startDate;
                } else {
                    var endDate = event.end.format("YYYY-MM-DD");
                }
                if (endDate < todayDate) {
                    element.addClass('pastEvent');
                }
                
                // Build the country list
                if (event.country) {
                    countryList.push(event.country);
                }
                
                // Build the category list
                categoryList.push(event.category);
            },
            eventAfterAllRender: function() {
                // Build the country list
                $('#filterCountries .inner a').slice(1).remove();
                countryList = countryList.filter(function(elem, index, self) {
                    return index === self.indexOf(elem);
                });
                countryList.sort();
                $(countryList).each(function(i, e) {
                    $('#filterCountries .inner').append('<a>' + countryList[i] + '</a>');
                });
            
                // Build the category list
                if (firstRun === 'Yes') {
                    $('#calendar .fc-right').prepend('<div class="categoryCheckboxes"></div>');
                    categoryList = categoryList.filter(function(elem, index, self) {
                        return index === self.indexOf(elem);
                    });
                    $(categoryList).each(function(i, e) {
                        var lCategory = categoryList[i].toLowerCase().replace(/\s/g, '');
                        $('#calendar .categoryCheckboxes').append('<span class="checkbox"><input type="checkbox" name="' + lCategory + '" value="yes" checked> ' + categoryList[i] + '</span>');
                    });                    
                } else {
                    $('#calendar .categoryCheckboxes .checkbox').hide();
                    $(categoryList).each(function(i, e) {
                        var lCategory = categoryList[i].toLowerCase().replace(/\s/g, '');
                        $('#calendar .categoryCheckboxes input[name="' +lCategory + '"]').parent().show();
                    });
                //    $(categoryUnchecked).each(function(i, e) {
                //        $('#calendar .categoryCheckboxes input[name="' + categoryUnchecked[i] + '"]').prop('checked', false);
                //    });    
                }
                
                // Clear variables
                firstRun = '';
                countryList = [];
                categoryList = [];
            },
            eventClick: function(event) {
                if (event.url) {
                    $('#eventPopupContent').load(event.url + ' #eventPopupContent .inner', function() {
    		            $('#calendarEventPopup').removeClass('loading');
    	            });
                    $("#calendarEventPopup").modal('show');
                    return false;
                }
            }
        });
        
        $('#calendarEventPopup').on('hidden.bs.modal', function(){
            $(this).addClass('loading');
        });
    
        $('#filterCountries').on('click', 'a', function(){
            countryFilter = $(this).text();
            $('#filterCountries .inner').slideToggle(300,'swing');
            $('#filterCountries .title').text(countryFilter);
            $('#calendar').fullCalendar('rerenderEvents');
        });
        
        $('#calendar').on('change', 'input[type="checkbox"]', function(){
        //    var categoryName = $(this).attr('name');
        //    if ($(this).is(':checked')) {
        //        categoryUnchecked = jQuery.grep(categoryUnchecked, function(value) {
        //            return value != categoryName;
        //        });
        //    } else {
        //        categoryUnchecked.push(categoryName);
        //    }
            $('#calendar').fullCalendar('rerenderEvents');
        });
        
    });
    
</script>

<style>
    [[getImageList?
      &tvname=`eventCategories`
      &tpl=`eventColourStyleTpl`
    ]]
</style>

	</body>
</html>