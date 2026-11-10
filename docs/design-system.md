# Sistema visual Medicura

## Dirección

Un espacio clínico sereno y legible. La cruz translúcida es el motivo principal del acceso y el resumen. El resto de la interfaz prioriza agenda, personas y acciones.

## Tokens

| Uso | Valor |
| --- | --- |
| Texto | #203d43 |
| Texto secundario | #5c7278 |
| Acción | #147d75 |
| Acción activa | #09665f |
| Acento azul | #456b99 |
| Fondo | #f0f5f6 |
| Vidrio | blanco al 65%, blur 16px |
| Títulos | Manrope, 600 |
| Texto | DM Sans, 400/500 |
| Radios | controles 9–11px, tarjetas 18–22px, acceso 30px |

## Composición

Acceso: relato e ilustración a la izquierda, dos entradas visibles a la derecha. Panel: navegación lateral, encabezado, resumen diario, métricas y agenda. En móvil la navegación se abre con botón y los formularios pasan a una columna.

## Movimiento

Entradas: 480ms, power2.out, desplazamiento de 16px y stagger 55ms. Diálogo/menú: 220ms y desplazamiento de 8–10px. Sin loops decorativos, animación de blur ni desplazamiento automático. Movimiento reducido conserva los estados finales sin transición.

## Implementación

Una sola hoja de estilos organizada por componentes, Vite, fuentes locales e iconos SVG. Estado textual además del color. Confirmaciones nativas con foco contenido. Impresión de reportes y resultados completos sin navegación lateral.
