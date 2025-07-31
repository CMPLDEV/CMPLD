<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach($pages as $row)
    <url>
     @if($row->slug=="home")    
      <loc>{{url('/')}}</loc>
     @else
      <loc>{{url('/'.$row->slug.'.html')}}</loc>
     @endif
      <lastmod>{{ $row->updated_at->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.6</priority>
    </url>
    @endforeach
    
    @foreach(categories() as $row)
    <url>
     <loc>{{url('/'.$row->slug.'.htm')}}</loc>
     <lastmod>{{ $row->updated_at->tz('UTC')->toAtomString() }}</lastmod>
     <changefreq>weekly</changefreq>
     <priority>0.6</priority>
    </url>
    @endforeach
    
    @foreach($products as $row)
    <url>
     <loc>{{url('/'.$row->slug.'.html')}}</loc>
     <lastmod>2024-10-29T11:40:15+00:00</lastmod>
     <changefreq>weekly</changefreq>
     <priority>0.6</priority>
    </url>
    @endforeach
    
    @foreach($blogs as $row)
    <url>
     <loc>{{url('blog/'.$row->slug)}}</loc>
     <lastmod>{{ $row->updated_at->tz('UTC')->toAtomString() }}</lastmod>
     <changefreq>weekly</changefreq>
     <priority>0.6</priority>
    </url>
    @endforeach
    

</urlset>