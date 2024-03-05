package models

import (
	"time"

	"gorm.io/gorm"
)

type Tenant struct {
	gorm.Model
	ID              uint `gorm:"primaryKey"`
	Name            string
	Email           string
	Id_Number       string
	ApartmentUnitID uint
	ApartmentUnit   ApartmentUnit `gorm:"foreignKey:ApartmentUnitID"`
	CreatedAt       time.Time
	UpdatedAt       time.Time
	DeletedAt       time.Time
}
