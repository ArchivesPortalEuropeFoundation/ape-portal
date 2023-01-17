[[!email? &content=`
<h4>[[+emailTitle:notempty=`[[+emailTitle]]`:default=`A new message from the APE website`]]</h4>
[[+name:notempty=`
<p>
    <strong><span style="text-decoration: underline;">Full name:</span></strong><br>
    [[+name]]
</p>
`]]
[[+email:notempty=`
<br/>
<p>
    <strong><span style="text-decoration: underline;">Email:</span></strong><br>
    [[+email]]
</p>
`]]
[[+subject:notempty=`
<br/>
<p>
    <strong><span style="text-decoration: underline;">Topic:</span></strong><br>
    [[+subject]]
</p>
`]]
[[+message:notempty=`
<br/>
<p>
    <strong><span style="text-decoration: underline;">Message (original):</span></strong><br>
    [[+message]]
</p>
`]]
[[+rating:notempty=`
<br/>
<p>
    <strong><span style="text-decoration: underline;">Rating:</span></strong><br>
    [[+rating]]
</p>
`]]
[[+feedback:notempty=`
<br/>
<p>
    <strong><span style="text-decoration: underline;">Feedback:</span></strong><br>
    [[+feedback]]
</p>
`]]
[[+recipient:notempty=`
<br/>
<p>
    <strong><span style="text-decoration: underline;">Suggestion type:</span></strong><br>
    [[+recipient:is=`toTopic`:then=`[[!%asi.action_assign_to_topic? &topic=`actions` &namespace=`asi`]]`]]
    [[+recipient:is=`toTranslation`:then=`[[!%asi.action_suggest_translation? &topic=`actions` &namespace=`asi`]]`]]
    [[+recipient:is=`toConnect`:then=`[[!%asi.action_connect_to_another_resource? &topic=`actions` &namespace=`asi`]]`]]
    [[+recipient:is=`toOther`:then=`Other`]]
</p>
`]]
[[+suggestion:notempty=`
<br/>
<p>
    <strong><span style="text-decoration: underline;">Suggestion details:</span></strong><br>
    [[+suggestion]]
</p>
`]]
[[+suggestionFile:notempty=`
<br/>
<p>
    <strong><span style="text-decoration: underline;">Uploaded files:</span></strong><br>
    [[+suggestionFile]]
</p>
`]]
[[+usage:notempty=`
<br/>
<p>
    <strong><span style="text-decoration: underline;">Usage of content:</span></strong><br>
    Agreed
</p>
`]]

<br/>
<p>
    <strong><span style="text-decoration: underline;">Page information:</span></strong><br>
    [[*pagetitle]] (Resource ID: [[*id]])

    [[+explore_exists:notempty=`
    <br/>
    <a href="[[!+URI]]">Visit here</a>
    `]]

    [[+archive.type:notempty=`
        <br/>
        <strong>Archive: </strong>
        <a href="[[!+URI]]">[[!+archive.title]]</a>
    `]]

    [[+name.title:notempty=`
        <br/>
        <strong>Name: </strong>
        <a href="[[!+URI]]">[[!+name.title]]</a>
    `]]

     [[+institution.name:notempty=`
        <br/>
        <strong>Institution: </strong>
        <a href="[[!+institutionLink]]">[[!+institution.name]]</a>
     `]]
</p>

[[-
<br/>
<p>
    [[+archive.recordid:notempty=`
        <strong>Record ID:</strong><br>
        [[+archive.recordid]]
    `]]
</p>
]]

`]]
