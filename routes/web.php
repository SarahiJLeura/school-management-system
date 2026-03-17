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
