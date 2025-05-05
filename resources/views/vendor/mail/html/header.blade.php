<tr>
  <td class="header" align="center" style="padding: 25px 0;">
    <a href="{{ $url }}" style="display: inline-flex; align-items: center; text-decoration: none;">
      {{-- Small Icon --}}
      <img
        src="{{ asset('favicon-32x32.png') }}"
        alt="{{ config('app.name') }} Icon"
        style="height: 32px; width: auto; margin-right: 12px;"
      />

      {{-- Main Logo or App Name --}}
      @if (config('app.logo'))
        <img
          src="{{ config('app.logo') }}"
          alt="{{ config('app.name') }} Logo"
          style="max-height: 50px; width: auto;"
        />
      @else
        <h2 style="margin: 0; padding: 0; font-size: 24px; font-weight: bold; color: #333;">
          {{ config('app.name') }}
        </h2>
      @endif
    </a>
  </td>
</tr>

