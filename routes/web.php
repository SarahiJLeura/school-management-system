<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

//register
route::get('/register', [AuthController::class, 'indexRegister'])->name('index.register');
route::post('/register', [AuthController::class, 'saveRegister'])->name('save.register');

//login
route::get('/login', [AuthController::class, 'indexLogin'])->name('index.login');
route::post('/login', [AuthController::class, 'saveLogin'])->name('save.login');
route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/**
 * ADMIN
 */

route::get('/dashboard', [AdminController::class, 'indexAdmin'])->name('index.admin');
//materias
route::get('/materias', [AdminController::class, 'indexMateria'])->name('index.materias');
route::post('/guardarMateria', [AdminController::class, 'saveMateria'])->name('save.materia');
route::delete('/eliminarmateria/{id}', [AdminController::class, 'deleteMateria'])->name('delete.materia');
route::get('/modificarmateria/{id}', [AdminController::class, 'editMateria'])->name('edit.materia');
route::put('/modificarmateria/{id}', [AdminController::class, 'updateMateria'])->name('update.materia');
//horarios
route::get('/horarios', [AdminController::class, 'indexHorario'])->name('index.horarios');
route::post('/guardarHorario', [AdminController::class, 'saveHorario'])->name('save.horario');
route::delete('/eliminarHorario/{id}', [AdminController::class, 'deleteHorario'])->name('delete.horario');
route::get('/modificarHorario/{id}', [AdminController::class, 'editHorario'])->name('edit.horario');
route::put('/modificarHorario/{id}', [AdminController::class, 'updateHorario'])->name('update.horario');
//grupos
route::get('/grupos', [AdminController::class, 'indexGrupo'])->name('index.grupos');
route::post('/guardarGrupo', [AdminController::class, 'saveGrupo'])->name('save.grupo');
route::delete('/eliminarGrupo/{id}', [AdminController::class, 'deleteGrupo'])->name('delete.grupo');
route::get('/modificarGrupo/{id}', [AdminController::class, 'editGrupo'])->name('edit.grupo');
route::put('/modificarGrupo/{id}', [AdminController::class, 'updateGrupo'])->name('update.grupo');
//calificacion
route::get('/calificaciones',[AdminController::class, 'indexCalificacion'])->name('index.calificaciones');
route::post('/guardarCalificacion', [AdminController::class, 'saveCalificacion'])->name('save.calificacion');
route::delete('/eliminarCalificacion/{id}', [AdminController::class, 'deleteCalificacion'])->name('delete.calificacion');
route::get('/modificarCalificacion/{id}', [AdminController::class, 'editCalificacion'])->name('edit.calificacion');
route::put('/modificarCalificacion/{id}', [AdminController::class, 'updateCalificacion'])->name('update.calificacion');
//inscripcion
route::get('/inscripciones',[AdminController::class, 'indexInscripciones'])->name('index.inscripciones');
route::post('/guardarInscripcion', [AdminController::class, 'saveInscripcion'])->name('save.inscripcion');
route::delete('/eliminarInscripcion/{id}', [AdminController::class, 'deleteInscripcion'])->name('delete.inscripcion');
route::get('/modificarInscripcion/{id}', [AdminController::class, 'editInscripcion'])->name('edit.inscripcion');
route::put('/modificarInscripcion/{id}', [AdminController::class, 'updateInscripcion'])->name('update.inscripcion');
