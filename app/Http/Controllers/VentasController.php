<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
class VentasController extends Controller
{
    public function listarProductos()
    {
        $producto = DB::table('producto')->get()->toArray();
        return ($producto);
    }

    public function listarPro() {
        $pro=DB::select('select * from producto');
        return response()->json($pro);
    }  
 
    public function buscarCliente($dni) {
        $clienteEncontrado = DB::table('persona')->where('dni', $dni)->get()->toArray();
        return ($clienteEncontrado);
    }

    public function listarClientes(){
        $cliente=DB::table('persona')->get()->toArray();
        return ($cliente);
    }


    public function crearVenta(Request $request) {

        $idventas = DB::table('ventas')->insertGetId([
            "idventas"=>null,
            "fecha"=>Carbon::now()->toDateString(),
            "idpersona"=>$request->idcliente,
            "idcliente"=>$request->idvendedor
        ]);  
   
    }  

    public function crearDetalle(Request $request){
        //sdgdfgdfg
        $idp=DB::select("select idventas from ventas order by idventas desc limit 1");
        foreach($idp as $i){
            DB::table('detalle_venta')->insert([
                "idventas"=>$i->idventas,  
                "idproducto"=>$request->idproducto,
                "precio"=>$request->precio,
                "cantidad"=>$request->cantidad
            ]);  
        }

        
    }

    
}
