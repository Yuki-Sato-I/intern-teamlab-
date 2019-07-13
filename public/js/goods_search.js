function check(e) {
  'use strict';
  if (document.form.price_lower.value > document.form.price_upper.value) {
    alert("最高価格と最低価格の入力箇所が反対です。");
  }else{
    document.form.submit();
  }
}