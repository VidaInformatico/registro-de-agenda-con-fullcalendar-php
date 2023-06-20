<?php
require_once '../conexion.php';
if (!empty($_GET['action'])) {
    switch ($_GET['action']) {
        case 'list':
            $sql = $con->prepare("SELECT * FROM agendas");
            $sql->execute();
            $array = array();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($data); $i++) {
                $datos['id'] = $data[$i]['id'];
                $datos['title'] = $data[$i]['titulo'];
                $datos['start'] = $data[$i]['fecha_inicio'];
                $datos['end'] = $data[$i]['fecha_fin'];
                $datos['color'] = $data[$i]['color'];
                array_push($array, $datos);
            }
            echo json_encode($array);
            break;
        case 'save':
            $json = file_get_contents('php://input');
            $array = json_decode($json, true);
            if (empty($array['id_evento'])) {
                $sql = $con->prepare("INSERT INTO agendas (titulo, fecha_inicio, fecha_fin, color) VALUES (:titulo,:inicio,:fin,:color)");
                $sql->bindParam(':titulo', $array['titulo']);
                $sql->bindParam(':inicio', $array['fecha_inicio']);
                $sql->bindParam(':fin', $array['fecha_fin']);
                $sql->bindParam(':color', $array['color']);
            } else {
                $sql = $con->prepare("UPDATE agendas SET titulo=:titulo, fecha_inicio=:inicio, fecha_fin=:fin, color=:color WHERE id=:id");
                $sql->bindParam(':titulo', $array['titulo']);
                $sql->bindParam(':inicio', $array['fecha_inicio']);
                $sql->bindParam(':fin', $array['fecha_fin']);
                $sql->bindParam(':color', $array['color']);
                $sql->bindParam(':id', $array['id_evento']);
            }
            $result = $sql->execute();
            if ($result) {
                $res = array('msg' => 'AGENDA GUARDADO', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL GUARDAR', 'type' => 'error');
            }
            echo json_encode($res);
            break;
        case 'delete':
            $id_evento = $_GET['id'];
            $sql = $con->prepare("DELETE FROM agendas WHERE id = :id");
            $sql->bindParam(':id', $id_evento);
            $result = $sql->execute();
            if ($result) {
                $res = array('msg' => 'AGENDA ELIMINADO', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'error');
            }
            echo json_encode($res);
            break;

        case 'update':
            $json = file_get_contents('php://input');
            $array = json_decode($json, true);
            $sql = $con->prepare("UPDATE agendas SET fecha_inicio=:inicio, fecha_fin=:fin WHERE id=:id");
            $sql->bindParam(':inicio', $array['fecha_inicio']);
            $sql->bindParam(':fin', $array['fecha_fin']);
            $sql->bindParam(':id', $array['id_evento']);
            $result = $sql->execute();
            if ($result) {
                $res = array('msg' => 'AGENDA MODIFICADO', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL MODIIFCAR', 'type' => 'error');
            }
            echo json_encode($res);
            break;

        default:
            # code...
            break;
    }
}
