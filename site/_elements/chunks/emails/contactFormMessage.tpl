[[!email? &content=`
<h3>A new message from [[++site_name]] website</h3>
<p class="lead">[[+fname]] [[+lname]] - [[+email]]</p>
<p>[[!%asi.phone? &topic=`default` &namespace=`asi`]]: [[+phone]]</p>
<p>Message:<br>[[+message]]</p>
<p>[[+GDPR:is=`Yes`:then=`GDPR consent has been given`:else=`GDPR consent has NOT been given`]]</p>
<p>Sent from [[*pagetitle]]</p>
`]]