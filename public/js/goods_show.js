function deleteGoods(e) {
  'use strict';
  if (confirm('本当に削除していいですか?')) {
    document.getElementById('del').submit();
  }
}