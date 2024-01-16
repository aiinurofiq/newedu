<div>
    <form
      class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative">
      <div class="row g-3">
        <div class="col-xl-3">
          <input
            wire:model="query"
            wire:keyup.debounce="filter"
            class="form-control me-1"
            type="search"
            placeholder="Enter keyword"
          />
        </div>
        <div class="col-xl-8">
          <div class="row g-3">
            <div class="col-sm-6 col-md-4 pb-2 pb-md-0">
              <select
                wire:model="category"
                wire:change="filter"
                class="form-select form-select-sm js-choice"
                aria-label=".form-select-sm example">
                <option value=''>Semua</option>
                @foreach ($categorylearns as $categorylearn )
                <option value="{{$categorylearn->name}}">{{$categorylearn->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </form>
</div>
