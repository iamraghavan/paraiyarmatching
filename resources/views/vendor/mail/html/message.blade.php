<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
{{ config('app.name') }}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset
<br>
<br>
{{-- Footer --}}
<table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td class="esd-email-paddings" valign="top">
                <table class="es-content esd-footer-popover" cellspacing="0" cellpadding="0" align="center">
                    <tbody>
                        <tr>
                            <td class="esd-stripe" align="center">
                                <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="es-p20t es-p20r es-p20l esd-structure" align="left">
                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="left" class="esd-block-image" style="font-size: 0px;"><a target="_blank"><img class="adapt-img" src="https://res.cloudinary.com/dwvybvefy/image/upload/v1718696654/logo-b_ooqieo.png" alt style="display: block;" height="45"></a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" class="esd-block-text es-p15">
                                                                                <p style="font-size: 16px; font-family: -apple-system, blinkmacsystemfont, 'segoe ui', roboto, helvetica, arial, sans-serif, 'apple color emoji', 'segoe ui emoji', 'segoe ui symbol'; line-height: 120%;"><strong>Disclaimer:</strong></p>
                                                                                <p style="font-size: 16px; font-family: -apple-system, blinkmacsystemfont, 'segoe ui', roboto, helvetica, arial, sans-serif, 'apple color emoji', 'segoe ui emoji', 'segoe ui symbol'; line-height: 120%;"><strong></strong></p>
                                                                                <p style="font-family: -apple-system, blinkmacsystemfont, 'segoe ui', roboto, helvetica, arial, sans-serif, 'apple color emoji', 'segoe ui emoji', 'segoe ui symbol'; line-height: 120%; text-align: justify;">Paraiyar Matching is not responsible for any fraudulent activities, including monetary fraud and illegal profile activities. This website is strictly intended for matrimonial purposes and not for dating or casual relationships.</p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<br>
<br>
{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }} <br> Powered By <span style="color: #eda73e"> Bumble Bees IT Solutions </span>
</x-mail::footer>
</x-slot:footer>

</x-mail::layout>
