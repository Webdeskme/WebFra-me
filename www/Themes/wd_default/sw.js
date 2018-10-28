// const version = "0.0.1";
// const cacheName = `WebDesk-app-${version}`;
// self.addEventListener('install', e => {
//   const timeStamp = Date.now();
//   e.waitUntil(
//     caches.open(cacheName).then(cache => {
//       return cache.addAll([
//         `/`,
//         `/index.html`,
//         '/index.php?page=index.php'
//         `/Plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css`,
//         `/Theme/default.php`,
//         `/www/Themes/wd_default/style.css`,
//         `/Plugins/jquery.min.js`,
//         `/Plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js`,
//         `/Plugins/fontawesome-free/svg-with-js/js/fontawesome-all.min.js`
//       ])
//           .then(() => self.skipWaiting());
//     })
//   );
// });
// self.addEventListener('fetch', function(event) {
// console.log(event.request.url);
// event.respondWith(
// caches.match(event.request).then(function(response) {
// return response || fetch(event.request);
// })
// );
// });
