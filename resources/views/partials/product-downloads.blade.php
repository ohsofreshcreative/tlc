@php
  $downloadsGroup = $downloadsGroup ?? get_field('product_downloads');
  $g = $downloadsGroup['g_downloads'] ?? null;

  $sectionHeader = $g['section_header'] ?? '';
  $sectionText   = $g['section_text'] ?? '';
  $items         = $g['r_downloads'] ?? [];

  $formatBytes = function ($bytes) {
    if (!$bytes || $bytes <= 0) return '';
    $units = ['B','KB','MB','GB','TB'];
    $pow = min(floor(log($bytes, 1024)), count($units)-1);
    return round($bytes / (1024 ** $pow), 1).' '.$units[$pow];
  };
@endphp

@if(!empty($items))
<section class="product-downloads -smt">
  <div class="__wrapper c-main grid grid-cols-1 lg:grid-cols-2 section-gap">
    <div class="__top">
      @if($sectionHeader)
        <h2 class="__title">{{ esc_html($sectionHeader) }}</h2>
      @endif

      @if($sectionText)
        <div class="__txt mt-2">
          {!! nl2br(e($sectionText)) !!}
        </div>
      @endif
    </div>

    <div class="__grid grid gap-6 md:grid-cols-2">
      @foreach($items as $i => $row)
        @php
          $file    = $row['file'] ?? null;
          $title   = trim($row['header'] ?? '') ?: ($file['title'] ?? ($file['filename'] ?? 'Plik'));
          $url     = $file['url'] ?? '';
          $id      = $file['ID']  ?? null;

          $ext = '';
          if (!empty($file['filename'])) {
            $ext = strtoupper(pathinfo($file['filename'], PATHINFO_EXTENSION));
          } elseif ($url) {
            $ext = strtoupper(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
          } elseif (!empty($file['mime_type'])) {
            $ext = strtoupper(explode('/', $file['mime_type'])[1] ?? '');
          }

          $sizeStr = '';
          if ($id) {
            $path = get_attached_file($id);
            if ($path && file_exists($path)) {
              $sizeStr = $formatBytes(filesize($path));
            }
          }
        @endphp

        <article class="__card radius-img border-p p-6 flex items-start gap-4 h-max">

          <div class=" grow">
		 	 <img class="mb-2" src="/wp-content/uploads/2025/10/file.svg"/>
            <b class="">{{ esc_html($title) }}</b>

            <div class="text-sm opacity-50 mt-1">
              @if($sizeStr)<span>{{ $sizeStr }}</span>@endif
              @if($sizeStr && $ext) <span>•</span> @endif
              @if($ext)<span>{{ $ext }}</span>@endif
            </div>

            @if($url)
              <div class="mt-3">
                <a class="btn inline-flex items-center gap-2 px-4 py-2 rounded-md border-p hover:opacity-50"
                   href="{{ esc_url($url) }}" download>
                  <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="#a08667" d="M12 3a1 1 0 0 1 1 1v8.586l2.293-2.293a1 1 0 1 1 1.414 1.414l-4.004 4.004a1 1 0 0 1-1.414 0L7.286 11.707a1 1 0 1 1 1.414-1.414L11 12.586V4a1 1 0 0 1 1-1ZM5 20a1 1 0 1 1 0-2h14a1 1 0 1 1 0 2H5Z"/>
                  </svg>
                  <span>Pobierz</span>
                </a>
              </div>
            @endif
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif
