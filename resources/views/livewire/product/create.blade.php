<div>
    <h2 class="text-center">Agregar un nuevo producto</h2>
    <div class="row justify-content-center" style="width: 100%">
        <form wire:submit.prevent="save">
            <label for="">Categoria del producto</label>
            <select wire:model="categorias_id" class="form-control">
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                @endforeach 
            </select>
            @error('categoria_id') <p class="error mb-2">{{ $message }}</p> @enderror

            <label for="">Prvoeedor del producto</label>
            <select wire:model="proveedores_id" class="form-control">
                @foreach($proveedores as $proveedor)
                    <option value="{{$proveedor->id}}">{{$proveedor->marca}}</option>
                @endforeach 
            </select>
            @error('proveedor_id') <p class="error mb-2">{{ $message }}</p> @enderror

            <label for="">Nombre del producto</label>
            <input type="text" wire:model="name" class="form-control mb-2">
            @error('name') <p class="error mb-2">{{ $message }}</p> @enderror

            <label for="">Descripción</label>
            <textarea cols="20" rows="5" wire:model="description" class="form-control mb-2"></textarea>
            @error('description') <p class="error mb-2">{{ $message }}</p> @enderror

            <label for="">Price</label>
            <input type="number" wire:model="price" class="form-control mb-2">
            @error('price') <p class="error mb-2">{{ $message }}</p> @enderror

            <label for="">Nombre de archivo (con extension)</label>
            <input type="text" wire:model="thumbnail" class="form-control mb-2">
            @error('name') <p class="error mb-2">{{ $message }}</p> @enderror

            <button type="submit" class="btn btn-outline-primary btn-block">Save</button>

        </form>
    </div>
</div>
