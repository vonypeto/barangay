<header class="header-blue" style="padding-bottom: 0px;">
    <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
        <div class="container-fluid"><a class="navbar-brand" href="#" style="font-size: 45px;font-family: bodoni mt;"><img src="{{ URL::to($image->url ?? 'Logo not set') }}" style="resize: both;width: 100px;margin-right: 30px;"><p class="navbar-brand" id="client_header_login" style="font-size: 45px;">{{ $image->barangay_name ?? 'Logo not set' }}</p></a>
        </div>
    </nav>
    <link rel="icon"
    type="image/png"
    href="{{  Storage::url($image->image ?? 'Logo not set')  }}">
</header>
