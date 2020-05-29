<!-- flatpickrを使用するために、ファイルを読み込み -->
<!-- flatpickrスクリプト -->
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<!-- 日本語化の為の追加スクリプト -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script>
    /** flatpickr JavaScriptライブラリ
   * 日付選択機能が実装できる
   */

  // 第一引数にflatpikcrで日付選択を行わせたい要素を指定、第二引数にオプションを渡す
  flatpickr(document.getElementById('due_date'), {
    local: 'ja', // 言語設定 曜日を日本語表記に
    dateFromat: 'Y/m/d', // 日付表記のフォーマット
    minDate: new Date() // 本日日付より前の過去の日付を入力できない制限
  });
</script>
