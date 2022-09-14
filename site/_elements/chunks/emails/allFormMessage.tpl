[[!email? &content=`
<h4>[[+emailTitle:notempty=`[[+emailTitle]]`:default=`A new message from the APE website`]]</h4>
[[+name:notempty=`
<p>
    <strong>Full name:</strong><br>
    [[+name]]
</p>
`]]
[[+email:notempty=`
<p>
    <strong>Email:</strong><br>
    [[+email]]
</p>
`]]
[[+subject:notempty=`
<p>
    <strong>Topic:</strong><br>
    [[+subject]]
</p>
`]]
[[+message:notempty=`
<p>
    <strong>Message (original):</strong><br>
    [[+message]]
</p>
`]]
[[+rating:notempty=`
<p>
    <strong>Rating:</strong><br>
    [[+rating]]
</p>
`]]
[[+feedback:notempty=`
<p>
    <strong>Feedback:</strong><br>
    [[+feedback]]
</p>
`]]
[[+recipient:notempty=`
<p>
    <strong>Suggestion type:</strong><br>
    [[+recipient:is=`toTopic`:then=`[[!%asi.action_assign_to_topic? &topic=`actions` &namespace=`asi`]]`]]
    [[+recipient:is=`toTranslation`:then=`[[!%asi.action_suggest_translation? &topic=`actions` &namespace=`asi`]]`]]
    [[+recipient:is=`toConnect`:then=`[[!%asi.action_connect_to_another_resource? &topic=`actions` &namespace=`asi`]]`]]
    [[+recipient:is=`toOther`:then=`Other`]]
</p>
`]]
[[+suggestion:notempty=`
<p>
    <strong>Suggestion details:</strong><br>
    [[+suggestion]]
</p>
`]]
[[+suggestionFile:notempty=`
<p>
    <strong>Uploaded files:</strong><br>
    [[+suggestionFile]]
</p>
`]]
[[+usage:notempty=`
<p>
    <strong>Usage of content:</strong><br>
    Agreed
</p>
`]]
<p>
    <strong>Page information:</strong><br>
    [[*pagetitle]] ([[*id]])
</p>
`]]

[[+recordId:notempty=`
    <strong>Record ID:</strong><br>
    [[*recordId]]
`]]