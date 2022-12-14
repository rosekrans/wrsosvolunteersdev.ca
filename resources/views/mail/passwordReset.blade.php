@component('mail::message')
<b>Hey {{$name->first_name }}! </b>
<br>
<div>    
    
    <p>We've received your request to reset your password to the WRSOS Volunteer Portal.</p>

    <p><b>Please click the secure link below to reset your password.</b></p> 
    <p>This link <i>expires 3 hours after it's sent</i>.</p>
    <p>If this time has passed, please go back and send another password reset request.</p>

    @component('mail::button', ['url' => $url, 'color' => 'blue'])
        Reset Password
    @endcomponent

    <p>If you have any questions or comments, please feel free to reply to this email and our technology team will respond as soon as possible.</p>
    <p>Thank you for being an awesome WRSOS Volunteer!</p>
    <p>Sincerely,</p> 
    <br><p>The WRSOS Management Team</p>
</div>  
<div>
    @component('mail::subcopy')
        If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below
        into your web browser: [{{ $url }}]({{ $url }})
    @endcomponent
</div>
@endcomponent



