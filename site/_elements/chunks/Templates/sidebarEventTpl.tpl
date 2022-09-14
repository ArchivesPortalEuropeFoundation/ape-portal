                    <div class="event">
                        <p class="date">
                            <i class="far fa-calendar-alt"></i> [[+tv.eventEnd:notempty=`[[+tv.eventStart:strtotime:date=`%e %b`]] - [[+tv.eventEnd:strtotime:date=`%e %b %Y`]]`:default=`[[+tv.eventStart:strtotime:date=`%e %b %Y`]]`]]
                        </p>
                        <h4>[[+tv.eventTitle:notempty=`[[+tv.eventTitle]]`:default=`[[+pagetitle]]`]]</h4>
                        [[+tv.eventCountry:notempty=`<p class="country"><i class="fas fa-map-marker-alt"></i> [[+tv.eventCountry]]</p>`]]
                        <a href="[[~[[+id]]]]">[[!%asi.action_more_details? &topic=`actions` &namespace=`asi`]]</a>
                    </div>