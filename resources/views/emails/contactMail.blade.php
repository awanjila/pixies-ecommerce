@component('mail::message')

# You Have Contact Mail From Pixies Technologies' Online Shop

**Name:** {{ $data['name'] }}
**Email:** {{ $data['email'] }}
**Telephone:** {{ $data['phone'] }}

@component('mail::panel')
**Message:**
{{ $data['enquiry'] }}
@endcomponent

@component('mail::button', ['url' => 'mailto:' . $data['email'], 'style' => 'background-color: #0f4a32ff; color: #ffffff; text-decoration: none; padding: 10px 20px;'])
Reply to {{ $data['name'] }}
@endcomponent

With Thanks, {{ $data['name'] }} <br>
{{ config('app.name') }}
@endcomponent
