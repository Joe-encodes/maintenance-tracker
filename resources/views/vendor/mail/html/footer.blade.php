<tr>
  <td class="content-cell" align="center">
    <img
      src="{{ asset('favicon-32x32.png') }}"
      alt="{{ config('app.name') }} Logo"
      class="h-8 sm:h-12 w-auto mx-auto mb-4"
    />
    <p style="font-size:12px; color:#999;">
      © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </p>
    {{-- add your website or support link if you want --}}
    <p style="font-size:12px; color:#999;">
      <a href="{{ config('app.url') }}/support">Support</a> ·
      <a href="{{ config('app.url') }}/privacy">Privacy Policy</a>
    </p>
  </td>
</tr>
