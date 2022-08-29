<div id="filter_wrapper">
    <div  class="mt-4 ml-auto">
        <label for="hdd">Harddisk Type</label>
        <select class="form-control" id="hdd">
            <option value=""></option>
            @forEach(\App\Enums\HddTypesEnum::getOptions() as $option)
                <option value="{{ $option['text'] }}">{{ $option['text'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-4 ml-auto">
        <label for="hdd">Ram</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="2GB" name="ram">
            <label class="form-check-label">2GB</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="4GB" name="ram">
            <label class="form-check-label">4GB</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="8GB" name="ram">
            <label class="form-check-label">8GB</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="12GB" name="ram">
            <label class="form-check-label">12GB</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="16GB" name="ram">
            <label class="form-check-label">16GB</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="24GB" name="ram">
            <label class="form-check-label">24GB</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="32GB" name="ram">
            <label class="form-check-label">32GB</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="48GB" name="ram">
            <label class="form-check-label">48GB</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="64GB" name="ram">
            <label class="form-check-label">64GB</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="96GB" name="ram">
            <label class="form-check-label">96GB</label>
    </div>

    <div class="mt-4 ml-auto">
      <label for="amount">Server Storage (250GB increments):</label>
      <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
      <input type="hidden" id="storage" name="storage" value="" />
    </div>
     
    <div id="slider"></div>

    <div  class="mt-4 ml-auto">
      <label for="hdd">Location</label>
      <select class="form-control" id="location">
          <option value=""></option>
      </select>
    </div>
    
    <div class="mt-4 ml-auto">
        <button class="btn btn-success" type="button" id="filter-button">Filter</button>
    </div>
</div>