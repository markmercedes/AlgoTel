<?php

namespace ModelActions;

class SearchAction extends Base
{
  function render($context, $options = [])
  {
?>
    <a class="btn btn-warning search-panel-displayer" href="#"><i class="fa fa-search"></i>
      Search
    </a>
<?php
  }
}
