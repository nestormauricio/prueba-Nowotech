# 🚀 PRUEBA TÉCNICA UNIFICADA - Sistema de RRHH

## 📋 Descripción

Prueba técnica para evaluar el desarrollo de un **Sistema de Gestión de RRHH** con **Event-Driven Architecture**, **DDD** y **CQRS**.

### ⏱️ Duración: 5-7 horas
### 🏗️ Stack Tecnológico:
- **Backend**: PHP 8.2+, Symfony 7
- **Frontend**: Vue.js 3, Pinia, Tailwind CSS
- **Base de Datos**: MySQL/PostgreSQL
- **Arquitectura**: Domain-Driven Design (DDD) + Event-Driven Architecture
- **Patrones**: CQRS, Event Sourcing, Sagas

## 📊 Funcionalidades a Implementar

### 1. **Gestión de Empleados** (Core Domain)
- Crear, editar, eliminar empleados
- Estados del empleado (Activo, Inactivo, Vacaciones, Baja)
- Gestión de departamentos y roles
- Historial de cambios y auditoría

### 2. **Sistema de Nóminas**
- Cálculo automático de nóminas
- Gestión de salarios y bonificaciones
- Cálculo de impuestos y retenciones
- Generación de recibos de salario

### 3. **Gestión de Vacaciones y Ausencias**
- Solicitud y aprobación de vacaciones
- Gestión de días festivos
- Control de ausencias y permisos
- Workflow de aprobación

### 4. **Event-Driven Architecture** ⭐
- **Domain Events** para cambios de estado
- **Event Sourcing** para auditoría completa
- **CQRS** para separación de lecturas/escrituras
- **Event Handlers** para procesos asíncronos
- **Sagas** para transacciones distribuidas

### 5. **APIs y Integración**
- API REST completa
- Autenticación JWT
- Documentación OpenAPI

## 🏆 Criterios de Evaluación

### Excelente (90-100 puntos)
- ✅ **Implementación completa y funcional** de todas las funcionalidades
- ✅ **Arquitectura DDD bien implementada** con separación clara de capas
- ✅ **Event-Driven Architecture** correctamente implementada
- ✅ **CQRS** implementado con separación de comandos y consultas
- ✅ **Event Sourcing** para auditoría completa
- ✅ **Sagas** para procesos complejos
- ✅ **Frontend moderno y responsive** con Vue.js 3
- ✅ **APIs REST completas** con documentación
- ✅ **Tests exhaustivos** (unit, integration, event handlers)
- ✅ **Código limpio** y bien documentado

### Muy Bueno (80-89 puntos)
- ✅ **Implementación funcional** de funcionalidades principales
- ✅ **Arquitectura DDD** implementada correctamente
- ✅ **Domain Events** implementados
- ✅ **CQRS básico** implementado
- ✅ **Frontend funcional** con componentes reutilizables
- ✅ **APIs REST** implementadas
- ✅ **Tests adecuados** (unit e integration)

### Bueno (70-79 puntos)
- ✅ **Implementación básica** de funcionalidades core
- ✅ **Estructura DDD** reconocible
- ✅ **Algunos Domain Events** implementados
- ✅ **Frontend básico** funcional
- ✅ **APIs básicas** implementadas
- ✅ **Tests básicos** presentes

## 📦 Entregables Requeridos

### 1. **Código Fuente**
- Repositorio Git con commits significativos
- README.md con instrucciones de instalación
- Documentación técnica del proyecto

### 2. **Documentación**
- Arquitectura del sistema
- **Event-Driven Architecture** (flujo de eventos, handlers)
- **CQRS Implementation** (separación de comandos/consultas)
- API Documentation (OpenAPI/Swagger)
- Guía de instalación y configuración

### 3. **Testing**
- Tests unitarios (mínimo 80% cobertura)
- Tests de integración
- **Tests de event handlers**
- Tests de APIs

### 4. **Deployment**
- Docker Compose para desarrollo
- Scripts de instalación
- Variables de entorno configuradas

## 🎯 Puntos Extra (Opcional)

### Funcionalidades Avanzadas
- ✅ **Event Sourcing** completo con reconstrucción de estado
- ✅ **CQRS** con bases de datos separadas (write/read models)
- ✅ **Sagas** complejas para procesos de onboarding
- ✅ **Projections** para vistas optimizadas
- ✅ **Event Store** con persistencia de eventos
- ✅ **Real-time notifications** con WebSockets
- ✅ **CI/CD pipeline** completo
- ✅ **Monitoring y logging** avanzado

### Optimizaciones
- ✅ **Caching** avanzado (Redis, Varnish)
- ✅ **Database optimization** (índices, particionamiento)
- ✅ **Performance testing** con JMeter/K6
- ✅ **Event replay** para debugging

## 🚀 Instrucciones para el Candidato

### 1. Configuración Inicial
```bash
# Clonar el proyecto
git clone <repository-url>
cd hrm-system

# Instalar dependencias
composer install
npm install

# Configurar base de datos
cp .env.example .env
# Editar .env con configuración de BD

# Ejecutar migraciones
php bin/console doctrine:migrations:migrate

# Cargar fixtures
php bin/console doctrine:fixtures:load

# Iniciar servidor de desarrollo
symfony server:start
npm run dev
```

### 2. Estructura de Desarrollo
- **Backend**: Implementar en `src/` siguiendo arquitectura DDD + Event-Driven
- **Frontend**: Desarrollar en `assets/` con Vue.js 3
- **Tests**: Crear en `tests/` con PHPUnit
- **Documentación**: Incluir en `docs/`

### 3. Evaluación Final
La evaluación se basará en:
1. **Funcionalidad** (35%): ¿El sistema funciona correctamente?
2. **Arquitectura** (30%): ¿Se aplica DDD y Event-Driven correctamente?
3. **Event-Driven** (20%): ¿Los eventos de dominio están bien implementados?
4. **Calidad de código** (10%): ¿El código es limpio y mantenible?
5. **Testing** (5%): ¿Hay tests adecuados?

## 📞 Recursos de Soporte

Durante la prueba, el candidato puede consultar:
- ✅ Documentación oficial de Symfony y Vue.js
- ✅ Stack Overflow para problemas específicos
- ✅ GitHub para ejemplos de código
- ❌ No está permitido copiar código completo de otros proyectos

## 🎯 Diferenciación Clave

- **Funcionalidad de Negocio**: Sistema de RRHH (empleados, nóminas, vacaciones)
- **Arquitectura Técnica**: Event-Driven Architecture con Domain Events, CQRS, Event Sourcing
- **Evaluación**: Se evalúa tanto la funcionalidad como el dominio de patrones arquitectónicos avanzados

**¡Buena suerte! 🚀** 