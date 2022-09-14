                        {
                            title    : '[[+tv.eventTitle:notempty=`[[+tv.eventTitle]]`:default=`[[+pagetitle]]`]]',
                            start    : '[[+tv.eventStart]]',
                            end      : '[[+tv.eventEnd:strtotime:add=`86400`:date=`%Y-%m-%d`]]',
                            category : '[[TaggerGetTags? &groups=`4` &resources=`[[+id]]` &rowTpl=`taggerNameTpl`]]',
                            country  : '[[+tv.eventCountryTest:notempty=`[[!nameCountry? &country=`[[+tv.eventCountryTest]]`]]`:default=`[[+tv.eventCountry]]`]]',
                            url      : '[[~[[+id]]]]'
                        }