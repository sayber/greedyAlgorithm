<?php
    /**
    * Алогитм "жадины"
    *
    * @param $poi     - массив POI [0...35..]
    * @param $matrix  - Матрица смежности на основе координат
    *
    * @param bool $max_poi
    * @return mixed
    */
   function greedyAlgorithm($poi, $matrix, $max_poi = false)
   {

        $arr_keys = [];                  // Список ID poi для исключения
        $first_id = $max_poi[0];         // Получаем самую удаленную точку
        $save_poi = $poi[$first_id];     // $save_poi = poi[24]

        $new = [$first_id => $save_poi]; // Создаем новый массив
        unset($poi[$first_id]);          // Сразу удаляем из источника POI
        $arr_keys[] = $first_id;

        $save_id = $first_id;
        $c = max(array_keys($poi));
        for ($i = 0; $c >= $i; $i++) {
            // Удаляем записанную ранее точку
            unset($poi[$save_id]);
            // Получаем мин. значение
            $min = $this->minNotNull($matrix[$save_id], $arr_keys);
            $key = $min['keys'][0];
            if (is_numeric($key)) {
                // Формируем список, который надо отдать
                $new[$key] = $poi[$key];
                // Записываем минемальный радиан
                // из матрицы смежности
                $new[$key]['radian'] = $min['min'];
                // Сохраняем IDs
                $save_id = $key;
                $arr_keys[] = $key;
            }
        }

       return $new;
   }
